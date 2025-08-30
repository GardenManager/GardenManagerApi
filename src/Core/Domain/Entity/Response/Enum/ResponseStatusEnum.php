<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Domain\Entity\Response\Enum;

enum ResponseStatusEnum: string
{
    case SUCCESS = 'success';
    case FAILED  = 'failed';
    case ERROR   = 'error';
}
