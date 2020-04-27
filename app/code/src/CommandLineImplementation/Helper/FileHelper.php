<?php

declare(strict_types=1);

namespace Dauer\CommandLineImplementation\Helper;

class FileHelper
{

    public function getFileContent(string $fileFullPathName)
    {
        if (!file_exists($fileFullPathName)) {
            throw new \InvalidArgumentException('Please, insert a valid file path');
        }

        return file_get_contents($fileFullPathName);
    }

    public function getPrivateKeyContent(?string $pathToPrivateKey = 'private.key')
    {
        return $this->fileGetContent($pathToPrivateKey);
    }

    private function fileGetContent(string $path) {
        return file_get_contents($path);
    }

    public function getPublicKeyContent(?string $pathToPublicKey = 'public.key')
    {
        return $this->fileGetContent($pathToPublicKey);
    }
}
