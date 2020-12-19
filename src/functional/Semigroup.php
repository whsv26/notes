<?php

declare(strict_types=1);

namespace App\functional;

/**
 * @psalm-template T
 */
abstract class Semigroup
{
    /**
     * @var T
     */
    protected $value;

    /**
     * @param T $value
     */
    public final function __construct(mixed $value)
    {
        $this->value = $value;
    }

    /**
     * @param T $x
     * @param T $y
     * @return Semigroup<T>
     */
    protected abstract function binaryOperation(mixed $x, mixed $y): Semigroup;

    /**
     * @param T $x
     * @return Semigroup<T>
     */
    public function combine(mixed $x): Semigroup
    {
        return $this->binaryOperation($this->value, $x);
    }
}