<?php

declare(strict_types=1);

use GardenManager\Api\Core\DatabaseServiceProvider;
use GardenManager\Api\Core\ErrorHandlerServiceProvider;
use GardenManager\Api\Core\EventDispatcherServiceProvider;
use GardenManager\Api\Core\HttpApplicationServiceProvider;
use GardenManager\Api\Core\LoggerServiceProvider;
use GardenManager\Api\Core\OrmServiceProvider;
use GardenManager\Api\Core\ResponseBuilderServiceProvider;

return [
    EventDispatcherServiceProvider::class,
    HttpApplicationServiceProvider::class,
    LoggerServiceProvider::class,
    ResponseBuilderServiceProvider::class,
    ErrorHandlerServiceProvider::class,
    DatabaseServiceProvider::class,
    OrmServiceProvider::class,
];
