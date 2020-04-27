<?php

declare(strict_types=1);

namespace Dauer\OpenSecureSocketsLayer\Api;

use Dauer\OpenSecureSocketsLayer\Exception\InvalidKeyGenerationException;

/**
 * Interface KeyCreationInterface
 *
 * @category PHP
 * @package  Dauer\OpenSecureSocketsLayer\Api
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
interface KeyGenerationInterface
{

    /** @var int Algorithm's key type */
    public const KEY_TYPE = OPENSSL_KEYTYPE_RSA;

    /** @var int Algorithm's key size */
    public const KEY_BITS = 4096;

    /**
     * Generate and export keys to a file
     *
     * @return void
     * @throws InvalidKeyGenerationException
     */
    public function generate(): void;
}
