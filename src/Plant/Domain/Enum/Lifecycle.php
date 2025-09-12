<?php

declare(strict_types=1);

namespace GardenManager\Api\Plant\Domain\Enum;

use GardenManager\Api\Core\Infrastructure\Validation\Contract\DumpableEnum;
use GardenManager\Api\Core\Infrastructure\Validation\DumpableEnumTrait;

enum Lifecycle: string implements DumpableEnum
{
    use DumpableEnumTrait;

    case EVERGREEN = 'evergreen';
    case BIENNIAL = 'biennial';
    case ANNUAL = 'annual';
    case PERENNIAL = 'perennial';
}
