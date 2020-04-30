<?php

declare(strict_types=1);

namespace Dauer\RsaImplementation\Model;

use Dauer\PrimeNumberGeneration\Api\GeneratePrimeNumberInterface;
use Dauer\PrimeNumberGeneration\Model\GeneratePrimeNumber;
use Dauer\RsaImplementation\Api\GeneratePairOfKeyInterface;

/**
 * Class GeneratePairOfKey
 *
 * @category PHP
 * @package  Dauer\RsaImplementation\Model
 * @author   Webjump Team <contato@webjump.com.br>
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 * @license  http://www.webjump.com.br Copyright
 * @link     http://www.webjump.com.br
 */
class GeneratePairOfKey implements GeneratePairOfKeyInterface
{

    /** @var GeneratePrimeNumber $generatePrimeNumbers */
    private $generatePrimeNumbers;

    /**
     * GeneratePairOfKey constructor.
     *
     * @param GeneratePrimeNumber $generatePrimeNumber
     */
    public function __construct(GeneratePrimeNumber $generatePrimeNumber)
    {
        $this->generatePrimeNumbers = $generatePrimeNumber;
    }

    /**
     * Create pair of keys
     *
     * @param int $keySize
     */
    public function create(int $keySize = 100)
    {
        $primeNumberP = $this->generatePrimeNumbers->execute($keySize)[rand(0, $keySize)];
        $primeNumberQ = $this->generatePrimeNumbers->execute($keySize)[rand(0, $keySize)];
        $firstPartPublicKey = $primeNumberP * $primeNumberQ;

        /** @var int $primeNumber */
        $primeNumber = GeneratePrimeNumberInterface::FIRST_PRIME_NUMBER;

        $secondPartOfPublicKey = ($primeNumberP - 1) * ($primeNumberQ - 1);

        while ($primeNumber < $secondPartOfPublicKey) {
            if ($this->getCoPrimeNumberToSecondPartOfPublicKey($primeNumber, $secondPartOfPublicKey) == 1) {
                break;
            } else {
                $primeNumber++;
            }
        }

        $publicKey = base64_encode(
            $firstPartPublicKey . '-' . $secondPartOfPublicKey . '-' . $primeNumber
        );

        file_put_contents('public.key', $publicKey);

        $privateKeyValue = 1 + ($firstPartPublicKey * $secondPartOfPublicKey) / $primeNumber;
        $privateKey = base64_encode('DAUER' . $privateKeyValue);

        file_put_contents('private.key', $privateKey);
    }

    /**
     * Get Co Prime number to generate the second part of the public key
     *
     * @param int $primeNumber
     * @param int $secondPartOfPublicKey
     *
     * @return int
     */
    private function getCoPrimeNumberToSecondPartOfPublicKey(int $primeNumber, int &$secondPartOfPublicKey)
    {
        while (true) {
            $temp = $primeNumber % $secondPartOfPublicKey;

            if ($temp == 0) {
                return $secondPartOfPublicKey;
            }

            $primeNumber = $secondPartOfPublicKey;
            $secondPartOfPublicKey = $temp;
        }
    }
}
