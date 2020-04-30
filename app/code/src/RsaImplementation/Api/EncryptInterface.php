<?php

declare(strict_types=1);

namespace Dauer\RsaImplementation\Api;

use Dauer\OpenSecureSocketsLayer\Exception\InvalidKeyGenerationException;

/**
 * Interface EncryptInterface
 *
 * @category PHP
 * @package  Dauer\RsaImplementation\Api
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
interface EncryptInterface
{

    /**
     * Encrypt data with private key
     *
     * @param string $data
     * @param string $encrypted
     *
     * @return string
     * @throws InvalidKeyGenerationException
     */
    public function encrypt(string $data, string &$encrypted);
}
