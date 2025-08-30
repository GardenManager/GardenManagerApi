<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Response\Contract;

use \JsonSerializable;

interface ResponseMetadataInterface extends JsonSerializable
{
    public function getName(): string;
}
