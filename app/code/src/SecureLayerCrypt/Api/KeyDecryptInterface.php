<?php

declare(strict_types=1);

namespace Dauer\SecureLayerCrypt\Api;

use Dauer\SecureLayerCrypt\Exception\CouldNotDecryptException;
use Dauer\SecureLayerCrypt\Exception\InvalidKeyGenerationException;

/**
 * Interface KeyDecryptInterface
 *
 * @category PHP
 * @package  Dauer\SecureLayerCrypt\Api
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
interface KeyDecryptInterface
{

    /**
     * Return an array with Decrypted content data
     *
     * @param string $encrypted
     * @param string $publicKey
     *
     * @return array
     * @throws CouldNotDecryptException
     * @throws InvalidKeyGenerationException
     */
    public function decryptContent(string $encrypted, string $publicKey): array;
}
