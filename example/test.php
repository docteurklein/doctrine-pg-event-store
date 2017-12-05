<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use DocteurKlein\DoctrineEventStore\Example\Entity;
use DocteurKlein\DoctrineEventStore\EventSubscriber;

require(__DIR__.'/../vendor/autoload.php');

$em = EntityManager::create(
    [
        'driver' => 'pdo_pgsql',
        'dbname' => 'florian',
        'user' => 'florian',
    ],
    Setup::createAnnotationMetadataConfiguration([__DIR__.'/src'], true)
);
$em->getEventManager()->addEventSubscriber(new EventSubscriber);

$em->persist(new Entity);
$em->persist(new Entity);
$em->persist(new Entity);
$em->persist(new Entity);
$em->flush();
$em->clear();

foreach ($em->getRepository(Entity::class)->findAll() as $entity) {
    $entity->shit();
}
$em->flush();
