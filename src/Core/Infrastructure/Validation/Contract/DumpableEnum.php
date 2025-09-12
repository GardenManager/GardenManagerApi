<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Validation\Contract;

interface DumpableEnum
{
    /**
     * @return array<string|int>
     */
    public static function getValidValues(): array;
}
