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
 *     elements: array<string>
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
            $isHeader = u($line)
                ->trimStart()
                ->startsWith('# ');

            $isListElement = u($line)
                ->trimStart()
                ->startsWith('- ');

            if ($isHeader) {
                return [...$headers, [
                    'header' => u($line)->trim()->after('# ')->toString(),
                    'elements' => []
                ]];
            }

            if ($isListElement) {
                $lastHeader = array_pop($headers);

                return [...$headers, [
                    'header'   => $lastHeader['header'],
                    'elements' => [
                        ...$lastHeader['elements'],
                        u($line)->trim()->after('- ')->toString()
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

            $elements = reduce_left(
                $header['elements'],
                fn (string $element, int $key, array $collection, string $acc): string => implode(PHP_EOL, [
                    $acc,
                    "  - [$element]($element)",
                ]),
                ''
            );

            return implode(PHP_EOL, [
                $acc,
                "- [{$header['header']}](#$ref)",
                $elements,
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
