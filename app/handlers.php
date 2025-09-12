<?php

declare(strict_types=1);

use GardenManager\Api\Plant\Application\Command\CreatePlantCommand;
use GardenManager\Api\Plant\Application\Handler\CreatePlantRequestHandler;

return [
    CreatePlantCommand::class => [
        CreatePlantRequestHandler::class,
    ],
];
