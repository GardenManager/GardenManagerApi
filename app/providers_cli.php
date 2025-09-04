<?php

declare(strict_types=1);

use GardenManager\Api\Core\Infrastructure\DependencyInjection\CliApplicationServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\DatabaseServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\EventDispatcherServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\LoggerServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\MigrationsServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\OrmServiceProvider;

return [
    EventDispatcherServiceProvider::class,
    CliApplicationServiceProvider::class,
    LoggerServiceProvider::class,
    DatabaseServiceProvider::class,
    OrmServiceProvider::class,
    MigrationsServiceProvider::class,
];
