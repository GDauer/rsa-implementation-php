<?php

declare(strict_types=1);

namespace Dauer\OpenSecureSocketsLayer\Api;

use Dauer\OpenSecureSocketsLayer\Exception\CouldNotDecryptException;

/**
 * Interface KeyDecryptInterface
 *
 * @category PHP
 * @package  Dauer\OpenSecureSocketsLayer\Api
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
interface KeyDecryptInterface
{

    /**
     * For Keys with 4096 bits of size, the max limit length will be 4096/8 = 512

     * @var string
     */
    public const DECRYPT_BITS_MAX_LENGTH = 512;

    /**
     * Return an array with Decrypted content data
     *
     * @param string $encrypted
     * @param string $publicKey
     *
     * @return array
     * @throws CouldNotDecryptException
     */
    public function decryptContent(string $encrypted, string $publicKey): array;
}
