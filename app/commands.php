<?php

declare(strict_types=1);

use Doctrine\Migrations\Tools\Console\Command\CurrentCommand;
use Doctrine\Migrations\Tools\Console\Command\DiffCommand;
use Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\ListCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\RollupCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\SyncMetadataCommand;
use Doctrine\Migrations\Tools\Console\Command\UpToDateCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\CollectionRegionCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\EntityRegionCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\QueryRegionCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand;
use Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand;
use Doctrine\ORM\Tools\Console\Command\InfoCommand;
use Doctrine\ORM\Tools\Console\Command\MappingDescribeCommand;
use Doctrine\ORM\Tools\Console\Command\RunDqlCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\CreateCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\DropCommand;
use Doctrine\ORM\Tools\Console\Command\SchemaTool\UpdateCommand;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;

return [
    'migrations:current'                => CurrentCommand::class,
    'migrations:diff'                   => DiffCommand::class,
    'migrations:dump-schema'            => DumpSchemaCommand::class,
    'migrations:execute'                => ExecuteCommand::class,
    'migrations:generate'               => GenerateCommand::class,
    'migrations:latest'                 => LatestCommand::class,
    'migrations:list'                   => ListCommand::class,
    'migrations:migrate'                => MigrateCommand::class,
    'migrations:rollup'                 => RollupCommand::class,
    'migrations:status'                 => StatusCommand::class,
    'migrations:sync-metadata-storage'  => SyncMetadataCommand::class,
    'migrations:up-to-date'             => UpToDateCommand::class,
    'migrations:version'                => VersionCommand::class,
    'orm:clear-cache:region:collection' => CollectionRegionCommand::class,
    'orm:clear-cache:region:entity'     => EntityRegionCommand::class,
    'orm:clear-cache:metadata'          => MetadataCommand::class,
    'orm:clear-cache:query'             => QueryCommand::class,
    'orm:clear-cache:region:query'      => QueryRegionCommand::class,
    'orm:clear-cache:result'            => ResultCommand::class,
    'orm:schema-tool:create'            => CreateCommand::class,
    'orm:schema-tool:drop'              => DropCommand::class,
    'orm:schema-tool:update'            => UpdateCommand::class,
    'orm:generate-proxies'              => GenerateProxiesCommand::class,
    'orm:info'                          => InfoCommand::class,
    'orm:mapping:describe'              => MappingDescribeCommand::class,
    'orm:run-dql'                       => RunDqlCommand::class,
    'orm:validate-schema'               => ValidateSchemaCommand::class,
];
