<?php

declare(strict_types=1);

namespace GardenManager\Api\Infrastructure\Core\Container\Contract;

interface ServiceProviderInterface
{
    /**
     * @return array<string, callable>
     */
    public function provide(): array;
}
