<?php

declare(strict_types=1);

namespace Dauer\OpenSecureSocketsLayer\Model;

use Dauer\OpenSecureSocketsLayer\Api\KeyGenerationInterface;
use Dauer\OpenSecureSocketsLayer\Exception\InvalidKeyGenerationException;

/**
 * Class KeyCreation
 *
 * @category PHP
 * @package  Dauer\OpenSecureSocketsLayer\Model
 * @author   Webjump Team <contato@webjump.com.br>
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 * @license  http://www.webjump.com.br Copyright
 * @link     http://www.webjump.com.br
 */
class KeyGeneration implements KeyGenerationInterface
{

    /**
     * @inheritDoc
     */
    public function generate(): void
    {
        $key = openssl_pkey_new([
            'private_key_bits' => self::KEY_BITS,
            'private_key_type' => self::KEY_TYPE,
        ]);

        if ($key === false) {
            throw new InvalidKeyGenerationException('Invalid Key');
        }

        openssl_pkey_export_to_file($key, 'private.key');

        /** @var array $keyDetails */
        $keyDetails = openssl_pkey_get_details($key);

        file_put_contents('public.key', $keyDetails['key']);
        openssl_free_key($key);
    }
}
