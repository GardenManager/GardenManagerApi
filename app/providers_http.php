<?php

declare(strict_types=1);

use GardenManager\Api\Core\DatabaseServiceProvider;
use GardenManager\Api\Core\ErrorHandlerServiceProvider;
use GardenManager\Api\Core\HttpApplicationServiceProvider;
use GardenManager\Api\Core\ResponseBuilderServiceProvider;

return [
    HttpApplicationServiceProvider::class,
    ResponseBuilderServiceProvider::class,
    ErrorHandlerServiceProvider::class,
    DatabaseServiceProvider::class,
];
