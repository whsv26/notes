<?php

declare(strict_types=1);

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Process\Process;

use function Functional\reduce_left;
use function Symfony\Component\String\u;

/**
 * @psalm-type Header = array {
 *     header: string,
 *     subheaders: array<string>
 * }
 * @param string $path
 * @return array<Header>
 */
function parseHeaders(string $path): array
{
    $lines = file($path);
    $parser = Parser::of([]);

    foreach ($lines as $line) {
        $parser = $parser->bind(function (array $headers) use ($line): array {
            $uLine = u($line)->trim();

            $isHeader = $uLine->startsWith('# ');
            $isSubHeader = $uLine->startsWith('- #### ');

            if ($isHeader) {
                return [...$headers, [
                    'header' => $uLine->after('# ')->toString(),
                    'subheaders' => []
                ]];
            }

            if ($isSubHeader) {
                $lastHeader = array_pop($headers);

                return [...$headers, [
                    'header'   => $lastHeader['header'],
                    'subheaders' => [
                        ...$lastHeader['subheaders'],
                        $uLine->after('- #### ')->toString()
                    ],
                ]];
            }

            return $headers;
        });
    }

    return $parser->getHeaders();
}

$dirs = glob(__DIR__ . '/doc/*/', GLOB_ONLYDIR);

foreach ($dirs as $dir) {
    $fromPattern = $dir . '*.md';
    $to = __DIR__ . '/../doc/' . basename($dir) . '.md';
    $commandLine = "pandoc --toc --from gfm --to gfm --output $to $fromPattern";

    Process::fromShellCommandline($commandLine)->run();
    $contents = file_get_contents($to);

    $headers = parseHeaders($to);

    $refMap = reduce_left(
        $headers,
        function (array $header, int $key, array $collection, string $acc): string {
            $ref = u($header['header'])
                ->replace(' ', '-')
                ->toString();

            $subheaders = reduce_left(
                $header['subheaders'],
                fn (string $subheader, int $key, array $collection, string $acc): string => implode(PHP_EOL, [
                    $acc,
                    sprintf("  - [%s](#%s)", ...[
                        $subheader,
                        u($subheader)->replace(' ', '-')->toString()
                    ]),
                ]),
                ''
            );

            return implode(PHP_EOL, [
                $acc,
                "- [{$header['header']}](#$ref)",
                $subheaders,
            ]);
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
