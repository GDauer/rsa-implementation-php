<?php

declare(strict_types=1);

namespace Dauer\SecureLayerCrypt\Exception;

/**
 * Class CouldNotEncryptException
 *
 * @category PHP
 * @package  Dauer\SecureLayerCrypt\Exception
 * @author   Gustavo Dauer <gustavo.dauer@webjump.com.br>
 */
class CouldNotEncryptException extends \Exception
{
    protected $message = 'Something went wrong. Could Not Encrypt Data!';
}
