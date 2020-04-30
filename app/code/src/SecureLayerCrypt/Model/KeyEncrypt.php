<?php

declare(strict_types=1);

namespace Dauer\SecureLayerCrypt\Model;

use Dauer\RsaImplementation\Model\EncryptData;
use Dauer\SecureLayerCrypt\Api\KeyEncryptInterface;
use Dauer\SecureLayerCrypt\Exception\CouldNotEncryptException;

/**
 * Class KeyEncrypt
 *
 * @category PHP
 * @package  Dauer\SecureLayerCrypt\Model
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
class KeyEncrypt implements KeyEncryptInterface
{

    /** @var EncryptData $encrypter */
    private $encryptData;

    /** @var array */
    private $encryptedContent = [];

    /**
     * KeyEncrypt constructor.
     *
     * @param EncryptData $encryptData
     */
    public function __construct(EncryptData $encryptData)
    {
        $this->encryptData = $encryptData;
    }

    /**
     * @inheritDoc
     */
    public function encryptContent(string $plainText, string $privateKey): array
    {
        $encrypted = '';

        /** @var array $splitContent */
        $splitContent = str_split($plainText, self::ENCRYPT_BITS_MAX_SIZE);

        foreach ($splitContent as $content) {
            /** @var bool $isEncrypted */
            $isEncrypted = $this->encryptData->encrypt($content, $encrypted);

            if ($isEncrypted === false) {
                throw new CouldNotEncryptException();
            }

            $this->encryptedContent[] = $encrypted;
        }

        return $this->encryptedContent;
    }
}
