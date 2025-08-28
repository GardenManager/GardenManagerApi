<?php

declare(strict_types=1);

/** @var ContainerInterface $container */

use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

require ROOT_PATH . '/app/bootstrap/env.php';

$containerCallable  = require ROOT_PATH . '/app/bootstrap/container.php';
$config             = require ROOT_PATH . '/app/bootstrap/config.php';
$container          = $containerCallable(ROOT_PATH . '/app/providers_cli.php', $config);

return $container->get(Application::class);


