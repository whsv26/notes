<?php

declare(strict_types=1);

namespace App\parser;

use App\functional\Semigroup;

/**
 * @extends Semigroup<array<AbstractMdHeader>>
 */
final class MdParser extends Semigroup
{
    /**
     * @param array<AbstractMdHeader> $x
     * @param array<AbstractMdHeader> $y
     * @return self
     */
    protected function binaryOperation(mixed $x, mixed $y): self
    {
        $listOne =& $x;
        $listTwo =& $y;

        /** @var array<AbstractMdHeader> $merged */
        $merged = array_merge($listOne, $listTwo);

        return self::of($merged);
    }

    /**
     * @param array<AbstractMdHeader> $x
     * @return self
     */
    public function combine(mixed $x): self
    {
        return $this->binaryOperation($this->value, $x);
    }

    public function combineOne(AbstractMdHeader $header): self
    {
        return $this->combine([$header]);
    }

    /**
     * @param array<AbstractMdHeader> $value
     * @return self
     */
    public static function of(array $value): MdParser
    {
        return new self($value);
    }

    /**
     * @return array<AbstractMdHeader>
     */
    public function getHeaders(): array
    {
        return $this->value;
    }
}