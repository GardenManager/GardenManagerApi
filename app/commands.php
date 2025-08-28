<?php

declare(strict_types=1);

use Doctrine\Migrations\Tools\Console\Command\DumpSchemaCommand;
use Doctrine\Migrations\Tools\Console\Command\ExecuteCommand;
use Doctrine\Migrations\Tools\Console\Command\GenerateCommand;
use Doctrine\Migrations\Tools\Console\Command\LatestCommand;
use Doctrine\Migrations\Tools\Console\Command\ListCommand;
use Doctrine\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\Migrations\Tools\Console\Command\RollupCommand;
use Doctrine\Migrations\Tools\Console\Command\StatusCommand;
use Doctrine\Migrations\Tools\Console\Command\SyncMetadataCommand;
use Doctrine\Migrations\Tools\Console\Command\VersionCommand;

return [
    'migrations:dump-schema'           => DumpSchemaCommand::class,
    'migrations:execute'               => ExecuteCommand::class,
    'migrations:generate'              => GenerateCommand::class,
    'migrations:latest'                => LatestCommand::class,
    'migrations:list'                  => ListCommand::class,
    'migrations:migrate'               => MigrateCommand::class,
    'migrations:rollup'                => RollupCommand::class,
    'migrations:status'                => StatusCommand::class,
    'migrations:sync-metadata-storage' => SyncMetadataCommand::class,
    'migrations:version'               => VersionCommand::class,

];
