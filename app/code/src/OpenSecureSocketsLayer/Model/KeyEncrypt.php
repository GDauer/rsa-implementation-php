<?php

declare(strict_types=1);

namespace Dauer\OpenSecureSocketsLayer\Model;

use Dauer\OpenSecureSocketsLayer\Api\KeyEncryptInterface;
use Dauer\OpenSecureSocketsLayer\Exception\CouldNotEncryptException;

/**
 * Class KeyEncrypt
 *
 * @category PHP
 * @package  Dauer\OpenSecureSocketsLayer\Model
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
class KeyEncrypt implements KeyEncryptInterface
{

    /** @var array */
    private $encryptedContent = [];

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
            $isEncrypted = openssl_private_encrypt(base64_encode($content), $encrypted, $privateKey);

            if ($isEncrypted === false) {
                throw new CouldNotEncryptException();
            }

            $this->encryptedContent[] = $encrypted;
        }

        return $this->encryptedContent;
    }
}
