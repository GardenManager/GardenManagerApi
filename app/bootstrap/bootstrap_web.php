<?php

declare(strict_types=1);

/** @var ContainerInterface $container */

use GardenManager\Api\Core\Infrastructure\Router\RouteProvider;
use Psr\Container\ContainerInterface;
use Slim\App;

require ROOT_PATH . '/app/bootstrap/env.php';

$containerCallable  = require ROOT_PATH . '/app/bootstrap/container.php';
$config             = require ROOT_PATH . '/app/bootstrap/config.php';
$container          = $containerCallable(ROOT_PATH . '/app/providers_http.php', $config);
$app                = $container->get(App::class);
$middlewareCallable = require ROOT_PATH . '/app/middlewares.php';

$middlewareCallable($app);
new RouteProvider(ROOT_PATH . '/app/routes')->load($app);

return $app;


