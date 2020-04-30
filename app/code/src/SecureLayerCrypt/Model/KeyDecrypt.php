<?php

declare(strict_types=1);

namespace Dauer\SecureLayerCrypt\Model;

use Dauer\SecureLayerCrypt\Api\KeyDecryptInterface;
use Dauer\SecureLayerCrypt\Exception\CouldNotDecryptException;
use Dauer\RsaImplementation\Model\DecryptData;

/**
 * Class KeyDecrypt
 *
 * @category PHP
 * @package  Dauer\SecureLayerCrypt\Model
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
class KeyDecrypt implements KeyDecryptInterface
{

    /** @var array $decryptedContent */
    private $decryptedContent = [];

    /** @var DecryptData $decryptData */
    private $decryptData;

    public function __construct(DecryptData $decryptData)
    {
        $this->decryptData = $decryptData;
    }

    /**
     * @inheritDoc
     */
    public function decryptContent(string $encrypted, string $publicKey): array
    {
        $decrypted = '';

        /** @var array $splitContent */
        $splitContent = str_split($encrypted, 400);

        foreach ($splitContent as $content) {
            /** @var bool $isEncrypted */
            $isEncrypted = $this->decryptData->decrypt($content, $decrypted);

            if ($isEncrypted === false) {
                throw new CouldNotDecryptException();
            }
            $this->decryptedContent[] = $decrypted;
        }

        return $this->decryptedContent;
    }
}
