<?php

declare(strict_types=1);

namespace App\parser;

class MdHeader2 extends AbstractMdHeader
{
    public static function prefix(): string
    {
        return '## ';
    }
}