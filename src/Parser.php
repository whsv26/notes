<?php

declare(strict_types=1);

namespace App;

use FunctionalPHP\FantasyLand\Apply;
use FunctionalPHP\FantasyLand\Functor;
use FunctionalPHP\FantasyLand\Monad;

use function Functional\map;

/**
 * @psalm-type Header = array {
 *     header: string,
 *     elements: array<string>
 * }
 */
class Parser implements Monad
{
    /**
     * @var array<Header>
     */
    private array $headers;

    /**
     * @param array<Header> $headers
     */
    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    public function ap(Apply $b): Apply
    {
        return $this;
    }

    /**
     * @param callable(array<Header>): array<Header> $function
     * @return self
     */
    public function bind(callable $function): self
    {
        return self::of($function($this->headers));
    }

    /**
     * @param callable(array<Header>): array<Header> $function
     * @return Functor
     */
    public function map(callable $function): Functor
    {
        return self::of(map($this->headers, $function));
    }

    /**
     * @param mixed $value
     * @param-out array<Header> $value
     * @return Parser
     */
    public static function of($value): self
    {
        assert(is_array($value));

        return new self($value);
    }

    /**
     * @return array<Header>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}