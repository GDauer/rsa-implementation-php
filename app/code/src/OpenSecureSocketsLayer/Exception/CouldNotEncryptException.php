<?php

declare(strict_types=1);

namespace Dauer\OpenSecureSocketsLayer\Exception;

/**
 * Class CouldNotEncryptException
 *
 * @category PHP
 * @package  Dauer\OpenSecureSocketsLayer\Exception
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
class CouldNotEncryptException extends \Exception
{
    protected $message = 'Something went wrong. Could Not Encrypt Data!';
}
