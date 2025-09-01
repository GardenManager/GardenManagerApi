<?php

declare(strict_types=1);

use GardenManager\Api\Core\CliApplicationServiceProvider;
use GardenManager\Api\Core\DatabaseServiceProvider;
use GardenManager\Api\Core\EventDispatcherServiceProvider;
use GardenManager\Api\Core\LoggerServiceProvider;
use GardenManager\Api\Core\MigrationsServiceProvider;
use GardenManager\Api\Core\OrmServiceProvider;

return [
    EventDispatcherServiceProvider::class,
    CliApplicationServiceProvider::class,
    LoggerServiceProvider::class,
    DatabaseServiceProvider::class,
    OrmServiceProvider::class,
    MigrationsServiceProvider::class,
];
