<?php

declare(strict_types=1);

namespace Dauer\SecureLayerCrypt\Api;

use Dauer\SecureLayerCrypt\Exception\CouldNotEncryptException;
use Dauer\SecureLayerCrypt\Exception\InvalidKeyGenerationException;

interface KeyEncryptInterface
{

    /**
     * Max bits per iteration
     *
     * @var string
     */
    public const ENCRYPT_BITS_MAX_SIZE = 245;

    /**
     * Return an array with encrypted data
     *
     * @param string $plainText
     * @param string $privateKey
     *
     * @return array
     * @throws CouldNotEncryptException
     * @throws InvalidKeyGenerationException
     */
    public function encryptContent(string $plainText, string $privateKey): array;
}
