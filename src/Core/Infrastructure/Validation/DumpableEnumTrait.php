<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Validation;

trait DumpableEnumTrait
{
    public static function getValidValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
