<?php

declare(strict_types=1);

use GardenManager\Api\Core\Infrastructure\Config\ConfigLoader;
use GardenManager\Api\Core\Infrastructure\Config\ConfigLocationResolver;

$loader = new ConfigLoader(
    new ConfigLocationResolver(
        ROOT_PATH . '/app/config',
        $_ENV['APP_ENV'],
    )
);

return $loader->resolveConfiguration();
