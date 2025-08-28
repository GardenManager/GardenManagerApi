<?php

declare(strict_types=1);

use GardenManager\Api\Core\CliApplicationServiceProvider;
use GardenManager\Api\Core\DatabaseServiceProvider;

return [
    CliApplicationServiceProvider::class,
    DatabaseServiceProvider::class,
];
