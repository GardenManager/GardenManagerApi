<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\DependencyInjection;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\Console\EntityManagerProvider;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\Contract\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bridge\Doctrine\Types\UlidType;
use function DI\autowire;
use function DI\get;

class OrmServiceProvider implements ServiceProviderInterface
{
    public function provide(): array
    {
        return [
            UlidType::class => autowire(),

            EntityManager::class => static function (ContainerInterface $container): EntityManager {
                $setup = ORMSetup::createAttributeMetadataConfig(
                    [
                        ROOT_PATH . '/src'
                    ],
                    $_ENV['APP_DEBUG'] === 'true',
                );

                $setup->setProxyDir(ROOT_PATH . '/var/cache/orm');
                $setup->setProxyNamespace('DoctrineProxies');
                $setup->setNamingStrategy(new UnderscoreNamingStrategy(CASE_LOWER));

                $entityManager = new EntityManager(
                    $container->get(Connection::class),
                    $setup
                );

                $platform = $entityManager->getConnection()->getDatabasePlatform();

                $platform->registerDoctrineTypeMapping('ulid', 'ulid');

                return $entityManager;
            },

            EntityManagerInterface::class => get(EntityManager::class),

            SingleManagerProvider::class => autowire(SingleManagerProvider::class)
                ->constructorParameter('entityManager', get(EntityManager::class)),

            EntityManagerProvider::class => get(SingleManagerProvider::class),
        ];
    }
}
