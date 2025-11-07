<?php

use Doctrine\Common\EventManager;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Events;
use Doctrine\ORM\ORMSetup;
use Webfactory\Bundle\DownloadBundle\Doctrine\DelegatingProviderFactory;
use Webfactory\Bundle\DownloadBundle\Doctrine\DownloadInjectionListener;
use Webfactory\Bundle\DownloadBundle\Doctrine\PropertyFactory;

class EntityManagerFactory
{
    public static function create(): EntityManagerInterface
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__],
            isDevMode: true,
        );
        $config->setLazyGhostObjectEnabled(true);

        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'path' => __DIR__.'/../tmp/db.sqlite',
        ], $config);

        $eventManager = new EventManager();
        // $eventManager->addEventListener([Events::postLoad], new PostLoadListener());

        $entityManager = new EntityManager($connection, $config, $eventManager);
        $entityManager->getEventManager()->addEventSubscriber(new PostLoadListener());
        $entityManager->getEventManager()->addEventSubscriber(new DownloadInjectionListener(new PropertyFactory(new DelegatingProviderFactory(), $entityManager)));

        return $entityManager;
    }
}
