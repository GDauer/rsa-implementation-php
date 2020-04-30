<?php

declare(strict_types=1);

namespace Dauer\RsaImplementation\Api;

/**
 * Class GeneratePairOfKeyInterface
 *
 * @category PHP
 * @package  Dauer\RsaImplementation\Api
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
interface GeneratePairOfKeyInterface
{

    /**
     * Create pair of keys
     *
     * @param int $keySize
     */
    public function create(int $keySize = 100);
}
