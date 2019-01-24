<?php
/*
 * This file is part of prooph/proophessor.
 * (c) 2014-2015 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * 
 * Date: 9/5/15 - 10:10 PM
 */

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */

use Doctrine\Migrations\Tools\Console\Command\{
    DiffCommand,
    ExecuteCommand,
    GenerateCommand,
    LatestCommand,
    MigrateCommand,
    StatusCommand,
    VersionCommand};
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Helper\HelperSet;

require 'vendor/autoload.php';

$container = require 'config/container.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = $container->get('doctrine.entitymanager.orm_default');

$cli = new Application('Doctrine Command Line Interface', '^2.0');

$helperSet = new HelperSet(
    [
        'dialog' => new \Symfony\Component\Console\Helper\QuestionHelper(),
        'em'     => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em),
        'db'     => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    ]
);

$cli->setCatchExceptions(true);
$cli->setHelperSet($helperSet);

$cli->addCommands(
    [
        new ExecuteCommand(),
        new GenerateCommand(),
        new LatestCommand(),
        new MigrateCommand(),
        new StatusCommand(),
        new VersionCommand(),
        new DiffCommand(),
    ]
);

$cli->run();





