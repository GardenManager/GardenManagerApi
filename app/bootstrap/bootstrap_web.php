<?php

declare(strict_types=1);

/** @var ContainerInterface $container */

use GardenManager\Api\Core\Domain\Event\OnApplicationInitializedEvent;
use GardenManager\Api\Core\Infrastructure\Router\RouteProvider;
use Psr\Container\ContainerInterface;
use Slim\App;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

require ROOT_PATH . '/app/bootstrap/env.php';

$containerCallable  = require ROOT_PATH . '/app/bootstrap/container.php';
$config             = require ROOT_PATH . '/app/bootstrap/config.php';
$container          = $containerCallable(ROOT_PATH . '/app/providers_http.php', $config);
$dispatcher         = $container->get(EventDispatcherInterface::class);
$app                = $container->get(App::class);
$middlewareCallable = require ROOT_PATH . '/app/middlewares.php';

$middlewareCallable($app);
new RouteProvider(ROOT_PATH . '/app/routes')->load($app);

$dispatcher->dispatch(new OnApplicationInitializedEvent($app, $container));

return $app;


