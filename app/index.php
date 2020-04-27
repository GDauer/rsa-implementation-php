<?php

declare(strict_types=1);

session_start();
require_once("../vendor/autoload.php");

use Dauer\CommandLineImplementation\Controller\CommandLine;
use Dauer\CommandLineImplementation\Helper\FileHelper;
use Dauer\OpenSecureSocketsLayer\Model\KeyDecrypt;
use Dauer\OpenSecureSocketsLayer\Model\KeyEncrypt;
use Dauer\OpenSecureSocketsLayer\Model\KeyGeneration;

$commandLineController = new CommandLine(new KeyGeneration(), new KeyEncrypt(), new KeyDecrypt(), new FileHelper());

$commandLineController->createApplication();


