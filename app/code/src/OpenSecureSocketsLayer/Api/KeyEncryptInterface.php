<?php

declare(strict_types=1);

namespace Dauer\OpenSecureSocketsLayer\Api;

use Dauer\OpenSecureSocketsLayer\Exception\CouldNotEncryptException;

interface KeyEncryptInterface
{

    /**
     * OpenSSL can not encrypt data bigger OR equal than it's decrypt capacity. So i'm using 2048/8 = 245
     *
     * @var string
     */
    public const ENCRYPT_BITS_MAX_SIZE = 245;

    /**
     * Return array with Encrypt data content
     *
     * @param string $plainText
     * @param string $privateKey
     *
     * @return array
     * @throws CouldNotEncryptException
     */
    public function encryptContent(string $plainText, string $privateKey): array;
}
