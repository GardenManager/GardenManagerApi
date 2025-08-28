<?php

declare(strict_types=1);

/** @var ContainerInterface $container */

use GardenManager\Api\Infrastructure\Core\Http\RouteProvider;
use Psr\Container\ContainerInterface;
use Slim\App;

require_once ROOT_PATH . '/app/bootstrap/env.php';
$container = require_once ROOT_PATH . '/app/bootstrap/container.php';

$app = $container->get(App::class);

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

new RouteProvider(ROOT_PATH . '/app/routes')->load($app);

return $app;


