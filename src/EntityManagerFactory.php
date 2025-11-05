<?php

use Doctrine\Common\EventManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\ORM\ORMSetup;

class EntityManagerFactory
{
    public static function create(): EntityManagerInterface
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__],
            isDevMode: true,
        );
        $config->enableNativeLazyObjects(true);

        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'path' => __DIR__.'/../tmp/db.sqlite',
        ], $config);

        $eventManager = new EventManager();
        $eventManager->addEventListener([Events::postLoad], new PostLoadListener());

        return new EntityManager($connection, $config, $eventManager);
    }
}
