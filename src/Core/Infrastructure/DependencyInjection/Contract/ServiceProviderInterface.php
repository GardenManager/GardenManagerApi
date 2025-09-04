<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\DependencyInjection\Contract;

interface ServiceProviderInterface
{
    /**
     * @return array<string, callable>
     */
    public function provide(): array;
}
