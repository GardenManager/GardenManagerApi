<?php

declare(strict_types=1);

use GardenManager\Api\Core\Infrastructure\DependencyInjection\DatabaseServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\ErrorHandlerServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\EventDispatcherServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\HttpApplicationServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\LoggerServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\MessengerServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\OrmServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\ResponseBuilderServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\SerializerServiceProvider;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\ValidatorServiceProvider;

return [
    EventDispatcherServiceProvider::class,
    HttpApplicationServiceProvider::class,
    LoggerServiceProvider::class,
    ResponseBuilderServiceProvider::class,
    ErrorHandlerServiceProvider::class,
    SerializerServiceProvider::class,
    ValidatorServiceProvider::class,
    MessengerServiceProvider::class,
    DatabaseServiceProvider::class,
    OrmServiceProvider::class,
];
