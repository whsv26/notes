<?php

declare(strict_types=1);

namespace App\parser;

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Process\Process;

use function Functional\reduce_left;
use function Symfony\Component\String\u;

/**
 * @param string $path
 * @return array<AbstractMdHeader>
 */
function parseHeaders(string $path): array
{
    $lines = file($path);
    $parser = MdParser::of([]);

    $lineToHeader = function (string $line): ?AbstractMdHeader {
        $uLine = u($line)->trim();

        return match (true) {
            $uLine->containsAny(MdHeader4::prefix()) => MdHeader4::fromTitle($uLine->after(MdHeader4::prefix())),
            $uLine->containsAny(MdHeader3::prefix()) => MdHeader3::fromTitle($uLine->after(MdHeader3::prefix())),
            $uLine->containsAny(MdHeader2::prefix()) => MdHeader2::fromTitle($uLine->after(MdHeader2::prefix())),
            $uLine->containsAny(MdHeader1::prefix()) => MdHeader1::fromTitle($uLine->after(MdHeader1::prefix())),
            default => null,
        };
    };

    foreach ($lines as $line) {
        $header = $lineToHeader($line);

        if (!$header instanceof AbstractMdHeader) {
            continue;
        }

        $parser = $parser->combineOne($header);
    }

    return $parser->getHeaders();
}

$dirs = glob(__DIR__ . '/doc/*/', GLOB_ONLYDIR);

foreach ($dirs as $dir) {
    $fromPattern = $dir . '*.md';
    $to = __DIR__ . '/../doc/' . basename($dir) . '.md';
    $commandLine = "pandoc --from gfm --to gfm --output $to $fromPattern";

    Process::fromShellCommandline($commandLine)->run();
    $contents = file_get_contents($to);

    $headers = parseHeaders($to);

    /** @var string $refMap */
    $refMap = reduce_left(
        $headers,
        function (AbstractMdHeader $header, int $key, array $collection, string $accumulator): string {
            $headerTitle = $header->title;
            $headerRef = u($headerTitle)->replace(' ', '-');

            return $accumulator . match ($header::class) {
                MdHeader1::class => "- [$headerTitle](#$headerRef)" . PHP_EOL,
                MdHeader4::class => "  - [$headerTitle](#$headerRef)" . PHP_EOL,
                default => '',
            };
        },
        ''
    );

    file_put_contents($to, implode(PHP_EOL, [
        '# ' . basename($dir),
        '**Contents**',
        $refMap,
        $contents
    ]));
}

echo 'doc has been built' . PHP_EOL;
