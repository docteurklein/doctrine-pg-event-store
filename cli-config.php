<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require(__DIR__.'/vendor/autoload.php');

return ConsoleRunner::createHelperSet(
    EntityManager::create(
        [
            'driver' => 'pdo_pgsql',
            'dbname' => 'florian',
            'user' => 'florian',
        ],
        Setup::createAnnotationMetadataConfiguration([__DIR__.'/src/Example'], true)
    )
);
