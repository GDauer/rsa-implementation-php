<?php

declare(strict_types=1);

namespace Dauer\CommandLineImplementation\Controller;

use Dauer\CommandLineImplementation\Api\CommandLineInterface;
use Dauer\CommandLineImplementation\Helper\FileHelper;
use Dauer\OpenSecureSocketsLayer\Exception\CouldNotDecryptException;
use Dauer\OpenSecureSocketsLayer\Exception\CouldNotEncryptException;
use Dauer\OpenSecureSocketsLayer\Exception\InvalidKeyGenerationException;
use Dauer\OpenSecureSocketsLayer\Model\KeyDecrypt;
use Dauer\OpenSecureSocketsLayer\Model\KeyEncrypt;
use Dauer\OpenSecureSocketsLayer\Model\KeyGeneration;

/**
 * Class CommandLine
 *
 * @category PHP
 * @package  Dauer\CommandLineImplementation\Controller
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
class CommandLine implements CommandLineInterface
{

    /** @var KeyGeneration $keyGeneration */
    private $keyGeneration;

    /** @var KeyEncrypt $keyEncrypt */
    private $keyEncrypt;

    /** @var KeyDecrypt $keyDecrypt */
    private $keyDecrypt;

    /** @var FileHelper $fileHelper */
    private $fileHelper;

    /**
     * CommandLine constructor.
     *
     * @param KeyGeneration $keyGeneration OpenSSL Key generation
     * @param KeyEncrypt    $keyEncrypt    OpenSSL Key Encrypt model
     * @param KeyDecrypt    $keyDecrypt    OpenSSL Key Decrypt model
     * @param FileHelper    $fileHelper    File Content Helper
     */
    public function __construct(
        KeyGeneration $keyGeneration,
        KeyEncrypt $keyEncrypt,
        KeyDecrypt $keyDecrypt,
        FileHelper $fileHelper
    ) {
        $this->keyGeneration = $keyGeneration;
        $this->keyEncrypt = $keyEncrypt;
        $this->keyDecrypt = $keyDecrypt;
        $this->fileHelper = $fileHelper;
    }

    /**
     * @inheritDoc
     */
    public function createApplication(?bool $isRepeated = false): void
    {
        if ($isRepeated === false) {
            print(self::CLI_INITIAL_MESSAGE . PHP_EOL);
        }

        $response = (int) readline(PHP_EOL . 'Choose: ' . PHP_EOL);

        if ($response === self::GENERATE_KEY_CHOOSE) {
            $this->generateKeysCommand();
        } elseif ($response === self::ENCRYPT_FILE_CONTENT_CHOOSE) {
            $this->encryptDataCommand();
        } elseif ($response === self::DECRYPT_FILE_CONTENT_CHOOSE) {
            $this->decryptDataCommand();
        } elseif ($response === self::DISPLAY_PAIRS_OF_KEYS) {
            $this->displayPairsOfKeysCommand();
        } else {
            print(PHP_EOL . self::INVALID_CLI_OPTION . PHP_EOL);
            $this->createApplication(true);
        }
    }

    /**
     * Generate new pairs of keys command.
     *
     * @return void
     * @throws InvalidKeyGenerationException
     */
    private function generateKeysCommand(): void
    {
        $this->keyGeneration->generate();
    }

    /**
     * Encrypt file data command
     *
     * @throws CouldNotEncryptException
     * @throws InvalidKeyGenerationException
     */
    private function encryptDataCommand()
    {
        /** @var string $filePath */
        $filePath = readline(self::INSERT_FILE_PATH_TEXT);

        /** @var string $fileContent */
        $fileContent = $this->fileHelper->getFileContent($filePath);

        /** @var string $privateKey */
        $privateKey = $this->fileHelper->getPrivateKeyContent();

        if ($privateKey === false) {
            $option = $this->couldNotFoundOption();

            if ($option == self::ENCRYPT_FILE_CONTENT_CHOOSE) {
                /** @var string $privateKeyFilePath */
                $privateKeyFilePath = readline('Insert a custom private Key path: ');
            } else {
                $privateKeyFilePath = 'private.key';
            }

            $privateKey = $this->fileHelper->getPrivateKeyContent($privateKeyFilePath);

            if ($privateKey === false) {
                throw new \InvalidArgumentException('Invalid Key');
            }
        }

        $encryptedFile = $this->keyEncrypt->encryptContent($fileContent, $privateKey);

        file_put_contents($filePath, $encryptedFile);
        print('The file has been Encrypted');
    }

    /**
     * Could Not Found Option.
     * "Custom Command" when user choose an invalid option.
     *
     * @param bool|null $isRepeated Flag for whether to display CLI message or not
     *
     * @return int|null
     * @throws InvalidKeyGenerationException
     */
    private function couldNotFoundOption(?bool $isRepeated = false)
    {
        if ($isRepeated === false) {
            print (self::CLI_COULD_NOT_FOUND_PRIVATE_KEY_MESSAGE . PHP_EOL);
        }

        $response = (int) readline(PHP_EOL . 'Choose: ');

        if ($response === self::GENERATE_KEY_CHOOSE) {
            $this->generateKeysCommand();
        } elseif ($response === self::ENCRYPT_FILE_CONTENT_CHOOSE) {
            return $response;
        } else {
            print(PHP_EOL . self::INVALID_CLI_OPTION . PHP_EOL);
            $response = $this->couldNotFoundOption(true);
        }
        return $response;
    }

    /**
     * Decrypt file data command
     *
     * @throws CouldNotDecryptException
     * @throws InvalidKeyGenerationException
     */
    private function decryptDataCommand()
    {
        $filePath = readline(self::INSERT_FILE_PATH_TEXT);

        $fileContent = $this->fileHelper->getFileContent($filePath);

        $publicKey = $this->fileHelper->getPublicKeyContent();

        if ($publicKey === false) {
            $option = $this->couldNotFoundOption();

            if ($option === self::ENCRYPT_FILE_CONTENT_CHOOSE) {
                /** @var string $publicKeyFilePath */
                $publicKeyFilePath = readline('Insert a custom public Key path: ');
            } else {
                $publicKeyFilePath = 'public.key';
            }

            $publicKey = $this->fileHelper->getPublicKeyContent($publicKeyFilePath);

            if ($publicKey === false) {
                throw new \InvalidArgumentException('Invalid Key');
            }
        }

        $decryptedFile = $this->keyDecrypt->decryptContent($fileContent, $publicKey);

        file_put_contents($filePath, $decryptedFile);
        print('The file has been Decrypted');
    }

    /**
     * Display Pairs of Generated Keys command.
     *
     * @return void
     * @throws InvalidKeyGenerationException
     */
    private function displayPairsOfKeysCommand(): void
    {
        if (!file_exists('public.key') || !file_exists('private.key')) {
            $option = $this->couldNotFoundOption();
        }

        if (!isset($option) || $option === self::GENERATE_KEY_CHOOSE) {
            print($this->fileHelper->getPublicKeyContent() . PHP_EOL);
            print($this->fileHelper->getPrivateKeyContent() . PHP_EOL);
        } else {
            print('You\'re using a custom pair of keys');
        }
    }
}
