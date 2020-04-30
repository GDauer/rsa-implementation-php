<?php

declare(strict_types=1);

session_start();
require_once("vendor/autoload.php");

use Dauer\CommandLineImplementation\Controller\CommandLine;
use Dauer\CommandLineImplementation\Helper\FileHelper;
use Dauer\SecureLayerCrypt\Model\KeyDecrypt;
use Dauer\SecureLayerCrypt\Model\KeyEncrypt;
use Dauer\SecureLayerCrypt\Model\KeyGeneration;
use Dauer\PrimeNumberGeneration\Model\GeneratePrimeNumber;
use Dauer\RsaImplementation\Model\EncryptData;
use Dauer\RsaImplementation\Model\DecryptData;
use Dauer\RsaImplementation\Model\GeneratePairOfKey;

$commandLineController = new CommandLine(
    new KeyGeneration(new GeneratePairOfKey(new GeneratePrimeNumber())),
    new KeyEncrypt(new EncryptData()),
    new KeyDecrypt(new DecryptData()),
    new FileHelper()
);

$commandLineController->createApplication();

