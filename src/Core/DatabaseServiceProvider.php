<?php

declare(strict_types=1);

namespace GardenManager\Api\Core;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Tools\DsnParser;
use Doctrine\Migrations\Configuration\Connection\ExistingConnection;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\RollupCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\SyncMetadataCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use GardenManager\Api\Core\Infrastructure\Container\Contract\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Command\ListCommand;

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

            'doctrineMigrations.configuration' => static function(ContainerInterface $container): ConfigurationArray {
                return new ConfigurationArray([
                    'migrations_paths' => [
                        'GardenManager\Migrations' => ROOT_PATH . '/var/migrations/',
                    ],
                    'table_storage'  => [
                        'table_name'                 => 'doctrine_migration_versions',
                        'version_column_name'        => 'version',
                        'version_column_length'      => 191,
                        'executed_at_column_name'    => 'executed_at',
                        'execution_time_column_name' => 'execution_time',
                    ],
                    'all_or_nothing' => true,
                    'transactional' => true,
                    'check_database_platform' => true,
                    'organize_migrations' => 'none',
                ]);
            },

            DependencyFactory::class => static function(ContainerInterface $container): DependencyFactory {
                return DependencyFactory::fromConnection(
                    $container->get('doctrineMigrations.configuration'),
                    new ExistingConnection($container->get(Connection::class)),
                );
            },

            DumpSchemaCommand::class => static function(ContainerInterface $container): DumpSchemaCommand {
                return new DumpSchemaCommand($container->get(DependencyFactory::class));
            },

            ExecuteCommand::class => static function(ContainerInterface $container): ExecuteCommand {
                return new ExecuteCommand($container->get(DependencyFactory::class));
            },

            GenerateCommand::class => static function(ContainerInterface $container): GenerateCommand {
                return new GenerateCommand($container->get(DependencyFactory::class));
            },

            LatestCommand::class => static function(ContainerInterface $container): LatestCommand {
                return new LatestCommand($container->get(DependencyFactory::class));
            },

            ListCommand::class => static function(ContainerInterface $container): ListCommand {
                return new ListCommand($container->get(DependencyFactory::class));
            },

            MigrateCommand::class => static function(ContainerInterface $container): MigrateCommand {
                return new MigrateCommand($container->get(DependencyFactory::class));
            },

            RollupCommand::class => static function(ContainerInterface $container): RollupCommand {
                return new RollupCommand($container->get(DependencyFactory::class));
            },

            StatusCommand::class => static function(ContainerInterface $container): StatusCommand {
                return new StatusCommand($container->get(DependencyFactory::class));
            },

            SyncMetadataCommand::class => static function(ContainerInterface $container): SyncMetadataCommand {
                return new SyncMetadataCommand($container->get(DependencyFactory::class));
            },

            VersionCommand::class => static function(ContainerInterface $container): VersionCommand {
                return new VersionCommand($container->get(DependencyFactory::class));
            },
        ];
    }
}
