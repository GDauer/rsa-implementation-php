<?php

declare(strict_types=1);

namespace Dauer\SecureLayerCrypt\Model;

use Dauer\RsaImplementation\Model\GeneratePairOfKey;
use Dauer\SecureLayerCrypt\Api\KeyGenerationInterface;

/**
 * Class KeyCreation
 *
 * @category PHP
 * @package  Dauer\SecureLayerCrypt\Model
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
class KeyGeneration implements KeyGenerationInterface
{

    /** @var GeneratePairOfKey $generatePairOfKey */
    private $generatePairOfKey;

    /**
     * KeyGeneration constructor.
     *
     * @param GeneratePairOfKey $generatePairOfKey
     */
    public function __construct(GeneratePairOfKey $generatePairOfKey)
    {
        $this->generatePairOfKey = $generatePairOfKey;
    }

    /**
     * @inheritDoc
     */
    public function generate(): void
    {
        $this->generatePairOfKey->create();
    }
}
