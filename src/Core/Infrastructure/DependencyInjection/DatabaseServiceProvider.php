<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\DependencyInjection;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\Contract\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class DatabaseServiceProvider implements ServiceProviderInterface
{
    public function provide(): array
    {
        return [
            Connection::class => static function(ContainerInterface $container): Connection {
                return DriverManager::getConnection(
                    new DsnParser()->parse($container->get('config.database.dsn')),
                );
            },
        ];
    }
}
