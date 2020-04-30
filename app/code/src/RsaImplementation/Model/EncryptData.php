<?php

declare(strict_types=1);

namespace Dauer\RsaImplementation\Model;

use Dauer\RsaImplementation\Api\EncryptInterface;
use Dauer\OpenSecureSocketsLayer\Exception\InvalidKeyGenerationException;

/**
 * Class EncryptData
 *
 * @category PHP
 * @package  Dauer\PrimeNumberGeneration\Model
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
class EncryptData implements EncryptInterface
{

    /**
     * @inheritDoc
     */
    public function encrypt(string $data, string &$encrypted)
    {
        if (file_exists('private.key')) {
            $privateKey = file_get_contents('private.key');
            $encrypted = $data . str_replace('DAUER', '', base64_decode($privateKey));
            $encrypted = base64_encode($encrypted);
            $encrypted = $this->invertData($encrypted);

            return $this->addMinLength($encrypted);
        }
        throw new InvalidKeyGenerationException('Could Not Find private Key');
    }

    /**
     * Invert letters positions
     *
     * @param string $data
     *
     * @return string
     */
    private function invertData(string $data)
    {
        $arrData = str_split($data, 1);
        $arrLength  = count($arrData);
        $newContent = '';

        for ($i = 1; $i <= $arrLength; $i++) {
            $newContent .= $arrData[$arrLength - $i];
        }
        return $newContent;
    }

    /**
     * Add string min length
     *
     * @param string $data
     *
     * @return string
     */
    private function addMinLength(string &$data)
    {
        $length = strlen($data);
        while ($length < 400) {
            $data .= '@';
            $length = strlen($data);
        }
        return $data;
    }
}
