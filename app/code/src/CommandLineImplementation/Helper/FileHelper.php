<?php

declare(strict_types=1);

namespace Dauer\CommandLineImplementation\Helper;

/**
 * Class FileHelper
 *
 * @category PHP
 * @package  Dauer\CommandLineImplementation\Helper
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
class FileHelper
{

    /**
     * Get file content
     *
     * @param string $fileFullPathName
     *
     * @return false|string
     */
    public function getFileContent(string $fileFullPathName)
    {
        if (!file_exists($fileFullPathName)) {
            throw new \InvalidArgumentException('Please, insert a valid file path');
        }

        return file_get_contents($fileFullPathName);
    }

    /**
     * Get Private Key
     *
     * @param string|null $pathToPrivateKey
     *
     * @return false|string
     */
    public function getPrivateKeyContent(?string $pathToPrivateKey = 'private.key')
    {
        return $this->fileGetContent($pathToPrivateKey);
    }

    /**
     * Get file content
     *
     * @param string $path
     *
     * @return false|string
     */
    private function fileGetContent(string $path) {
        return file_get_contents($path);
    }

    /**
     * Get public key
     *
     * @param string|null $pathToPublicKey
     *
     * @return false|string
     */
    public function getPublicKeyContent(?string $pathToPublicKey = 'public.key')
    {
        return $this->fileGetContent($pathToPublicKey);
    }
}
