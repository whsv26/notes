<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Process\Process;

use function Functional\reduce_left;
use function Symfony\Component\String\u;

$dirs = glob(__DIR__ . '/doc/*/', GLOB_ONLYDIR);

foreach ($dirs as $dir) {
    $fromPattern = $dir . '*.md';
    $to = __DIR__ . '/../doc/' . basename($dir) . '.md';
    $commandLine = "pandoc --from gfm --to gfm --output $to $fromPattern";

    Process::fromShellCommandline($commandLine)->run();
    $contents = file_get_contents($to);

    preg_match_all('/#\s(.+?)$/um', $contents, $matches);
    $headers = $matches[1] ?? [];

    implode(PHP_EOL, [
        '# ' . basename($dir),
        '**Contents**',
    ]);

    $refMap = reduce_left($headers, function (string $header, int $key, array $collection, $initial) {
        $ref = u($header)
            ->replace(' ', '-')
            ->toString();

        return $initial . "- [$header](#$ref)" . PHP_EOL;
    }, '');

    file_put_contents($to, implode(PHP_EOL, [
        '# ' . basename($dir),
        PHP_EOL,
        '---',
        '**Contents**',
        $refMap,
        $contents
    ]));
}
