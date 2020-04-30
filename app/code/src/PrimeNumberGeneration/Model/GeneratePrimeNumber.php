<?php

declare(strict_types=1);

namespace Dauer\PrimeNumberGeneration\Model;

use Dauer\PrimeNumberGeneration\Api\GeneratePrimeNumberInterface;

/**
 * Class GeneratePrimeNumber
 *
 * @category PHP
 * @package  Dauer\PrimeNumberGeneration\Model
 * @author   Webjump Team <contato@webjump.com.br>
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 * @license  http://www.webjump.com.br Copyright
 * @link     http://www.webjump.com.br
 */
class GeneratePrimeNumber implements GeneratePrimeNumberInterface
{

    /** @var int $primeNumber */
    private $primeNumber = 2;

    /** @var array $generatedPrimeNumbers */
    private $generatedPrimeNumbers = [];

    /**
     * @inheritDoc
     */
    public function execute(int $size = 100): array
    {
        $count = 0;

        while ($count < $size) {
            $countPrimeDiv = 0;

            for ($i = 1; $i <= $this->primeNumber; $i++) {
                if (($this->primeNumber % $i) == 0) {
                    $countPrimeDiv++;
                }
            }

            if ($countPrimeDiv < 3) {
                $this->generatedPrimeNumbers[] = $this->primeNumber;
                $count++;
            }
            $this->primeNumber++;
        }
        return $this->generatedPrimeNumbers;
    }
}
