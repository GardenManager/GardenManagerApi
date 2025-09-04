<?php

declare(strict_types=1);

use GardenManager\Api\Core\Infrastructure\DependencyInjection\DatabaseServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\ErrorHandlerServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\EventDispatcherServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\HttpApplicationServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\LoggerServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\OrmServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\ResponseBuilderServiceProvider;

return [
    EventDispatcherServiceProvider::class,
    HttpApplicationServiceProvider::class,
    LoggerServiceProvider::class,
    ResponseBuilderServiceProvider::class,
    ErrorHandlerServiceProvider::class,
    DatabaseServiceProvider::class,
    OrmServiceProvider::class,
];
