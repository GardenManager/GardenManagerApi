<?php

declare(strict_types=1);

/** @var ContainerInterface $container */

use Psr\Container\ContainerInterface;

$container = require_once ROOT_PATH . '/app/bootstrap/container.php';

$app = \Slim\Factory\AppFactory::createFromContainer($container);

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

return $app;
