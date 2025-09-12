<?php

declare(strict_types=1);

namespace GardenManager\Api\Plant\Application\Handler;

use GardenManager\Api\Plant\Application\Command\CreatePlantCommand;

class CreatePlantRequestHandler
{
    public function __invoke(CreatePlantCommand $command): void
    {
        die(var_dump($command->localName)??1);
    }
}
