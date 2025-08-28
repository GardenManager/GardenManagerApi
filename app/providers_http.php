<?php

declare(strict_types=1);

use GardenManager\Api\Core\DatabaseServiceProvider;
use GardenManager\Api\Core\HttpApplicationServiceProvider;

return [
    HttpApplicationServiceProvider::class,
    DatabaseServiceProvider::class
];
