<?php

declare(strict_types=1);

namespace Dauer\RsaImplementation\Model;

use Dauer\RsaImplementation\Api\DecryptInterface;
use Dauer\OpenSecureSocketsLayer\Exception\InvalidKeyGenerationException;

/**
 * Class DecryptData
 *
 * @category PHP
 * @package  Dauer\RsaImplementation\Model
 * @author   Webjump Team <contato@webjump.com.br>
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 * @license  http://www.webjump.com.br Copyright
 * @link     http://www.webjump.com.br
 */
class DecryptData implements DecryptInterface
{

    private $privateKeyTmp = '';

    /**
     * @inheritDoc
     */
    public function decrypt(string $data, string &$decrypted)
    {
        if (file_exists('public.key')) {
            $publicKey = file_get_contents('public.key');

            $this->setPrivateKeyTmp($publicKey);
            $this->removeMinLength($data);
            $this->revertData($data, false);
            $this->removePrivateKey($data);

            return $decrypted = $data;
        }
        throw new InvalidKeyGenerationException('Could Not Find public Key');
    }

    /**
     * Set private key tmp based on public key
     *
     * @param $publicKey
     */
    private function setPrivateKeyTmp($publicKey)
    {
        /** @var array $publicKeyParts */
        $publicKeyParts = $this->getPublicKeyParts($publicKey);

        $this->privateKeyTmp = 1 + ($publicKeyParts[0] * $publicKeyParts[1]) / $publicKeyParts[2];
    }

    /**
     * Get all public key parts
     *
     * @param $publicKey
     *
     * @return array|false|string[]
     */
    private function getPublicKeyParts($publicKey)
    {
        return preg_split('(-)', base64_decode($publicKey));
    }

    /**
     * Remove min length character
     *
     * @param $data
     */
    private function removeMinLength(&$data)
    {
        $data = preg_replace('(@)', '', $data);
    }

    /**
     * Remove private key
     *
     * @param $data
     */
    private function removePrivateKey(&$data)
    {
        $data = preg_replace("($this->privateKeyTmp)", '', base64_decode($data));
    }

    /**
     * Revert data
     *
     * @param $data
     * @param bool $isBase64
     */
    private function revertData(&$data, bool $isBase64 = true)
    {
        $data = ($isBase64 === true) ? base64_decode($data) : $data;

        $arrData = str_split($data, 1);
        $arrLength  = count($arrData);
        $newContent = '';

        for ($i = 1; $i <= $arrLength; $i++) {
            $newContent .= $arrData[$arrLength - $i];
        }

        $data = $newContent;
    }
}
