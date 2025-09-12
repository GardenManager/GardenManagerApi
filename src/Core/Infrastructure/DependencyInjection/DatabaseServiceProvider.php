<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\DependencyInjection;

use Carbon\Doctrine\DateTimeImmutableType;
use Carbon\Doctrine\DateTimeType;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use Doctrine\DBAL\Types\Type;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\Contract\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Symfony\Bridge\Doctrine\Types\UlidType;

class DatabaseServiceProvider implements ServiceProviderInterface
{
    public function provide(): array
    {
        return [
            Connection::class => static function(ContainerInterface $container): Connection {
                Type::addType('ulid', UlidType::class);
                Type::overrideType('datetime_immutable', DateTimeImmutableType::class);
                Type::overrideType('datetime', DateTimeType::class);

                return DriverManager::getConnection(
                    new DsnParser()->parse($container->get('config.database.dsn')),
                );
            },
        ];
    }
}
