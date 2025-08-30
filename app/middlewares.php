<?php

declare(strict_types=1);

use GardenManager\Api\Core\Infrastructure\Response\Middleware\ResponseMetadataFactoryMiddleware;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

return function (App $app): void {
    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
    $app->add(ResponseMetadataFactoryMiddleware::class);
    $app->add(ErrorMiddleware::class);
};
