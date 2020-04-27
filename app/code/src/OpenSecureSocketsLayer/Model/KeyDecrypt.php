<?php

declare(strict_types=1);

namespace Dauer\OpenSecureSocketsLayer\Model;

use Dauer\OpenSecureSocketsLayer\Api\KeyDecryptInterface;
use Dauer\OpenSecureSocketsLayer\Exception\CouldNotDecryptException;

/**
 * Class KeyDecrypt
 *
 * @category PHP
 * @package  Dauer\OpenSecureSocketsLayer\Model
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
class KeyDecrypt implements KeyDecryptInterface
{

    /** @var array $decryptedContent */
    private $decryptedContent = [];

    /**
     * @inheritDoc
     */
    public function decryptContent(string $encrypted, string $publicKey): array
    {
        $decrypted = '';

        /** @var array $splitContent */
        $splitContent = str_split($encrypted, self::DECRYPT_BITS_MAX_LENGTH);

        foreach ($splitContent as $content) {
            /** @var bool $isEncrypted */
            $isEncrypted = openssl_public_decrypt($content, $decrypted, $publicKey);

            if ($isEncrypted === false) {
                throw new CouldNotDecryptException();
            }
            $this->decryptedContent[] = base64_decode($decrypted);
        }

        return $this->decryptedContent;
    }
}
