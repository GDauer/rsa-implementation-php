<?php

declare(strict_types=1);

namespace Dauer\PrimeNumberGeneration\Api;

interface GeneratePrimeNumberInterface
{

    /** @var int */
    public const FIRST_PRIME_NUMBER = 2;

    /**
     * Get an array with prime numbers
     *
     * @param int $size
     *
     * @return array
     */
    public function execute(int $size = 100): array;
}
