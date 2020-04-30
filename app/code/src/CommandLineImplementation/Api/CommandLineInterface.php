<?php

declare(strict_types=1);

namespace Dauer\CommandLineImplementation\Api;

use Dauer\SecureLayerCrypt\Exception\CouldNotDecryptException;
use Dauer\SecureLayerCrypt\Exception\CouldNotEncryptException;
use Dauer\SecureLayerCrypt\Exception\InvalidKeyGenerationException;

/**
 * Interface CommandLineInterface
 *
 * @category PHP
 * @package  Dauer\CommandLineImplementation\Api
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
interface CommandLineInterface
{

    public const CLI_INITIAL_MESSAGE = <<<CLIM
Welcome to my Command Line Interface script for RSA implementation.
This is a simple script for academic and study purpose.
In this script you can:
(1) - Generate a pair of key for Encrypt and Decrypt purpose
(2) - Encrypt data
(3) - Decrypt data
(4) - Display those key
**** Follow me on github https://github.com/GDauer ****
-------------- Please, select one of those --------------
CLIM;

    public const CLI_COULD_NOT_FOUND_PRIVATE_KEY_MESSAGE = <<<CCNFPKM
Seems we could not found a complete pairs of keys generated in your system, would you like to generate a new pair or
use a custom key instead?
(1) - Generate a new pair of Keys
(2) - Custom key
CCNFPKM;

    /** @var int generate new pairs of keys option */
    public const GENERATE_KEY_CHOOSE = 1;

    /** @var int encrypt specific file */
    public const ENCRYPT_FILE_CONTENT_CHOOSE = 2;

    /** @var int decrypt specific file */
    public const DECRYPT_FILE_CONTENT_CHOOSE = 3;

    /** @var int display generated keys */
    public const DISPLAY_PAIRS_OF_KEYS = 4;

    /** @var string */
    public const INSERT_FILE_PATH_TEXT = 'Please, Insert file full path name (i.ex: ../test.txt): ';

    /** @var string */
    public const INVALID_CLI_OPTION = 'Invalid Command, please select a valid option!';

    /**
     * Create Cli Application
     *
     * @param bool|null $isRepeated
     *
     * @return void
     * @throws CouldNotDecryptException
     * @throws CouldNotEncryptException
     * @throws InvalidKeyGenerationException
     */
    public function createApplication(?bool $isRepeated = false): void;
}
