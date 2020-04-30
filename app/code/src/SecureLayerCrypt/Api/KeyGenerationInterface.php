<?php

declare(strict_types=1);

namespace Dauer\SecureLayerCrypt\Api;

use Dauer\SecureLayerCrypt\Exception\InvalidKeyGenerationException;

/**
 * Interface KeyCreationInterface
 *
 * @category PHP
 * @package  Dauer\SecureLayerCrypt\Api
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
interface KeyGenerationInterface
{

    /**
     * Generate and export keys to a file
     *
     * @return void
     * @throws InvalidKeyGenerationException
     */
    public function generate(): void;
}
