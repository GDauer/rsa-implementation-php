<?php

declare(strict_types=1);

namespace Dauer\RsaImplementation\Api;

use Dauer\OpenSecureSocketsLayer\Exception\InvalidKeyGenerationException;

/**
 * Interface DecryptInterface
 *
 * @category PHP
 * @package  Dauer\RsaImplementation\Api
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
interface DecryptInterface
{

    /**
     * Encrypt data with private key
     *
     * @param string $data
     * @param string $decrypted
     * @return string
     * @throws InvalidKeyGenerationException
     */
    public function decrypt(string $data, string &$decrypted);
}
