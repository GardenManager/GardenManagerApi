<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Config;

readonly class ConfigLoader
{
    public function __construct(
        private ConfigLocationResolver $locationResolver,
    )
    {
    }

    /**
     * @return array<string, mixed>
     */
    public function resolveConfiguration(): array
    {
        $files          = $this->locationResolver->resolveByEnvironment();
        $configurations = [];

        foreach ($files as $file) {
            $configurations[] = require $file;
        }

        return array_merge(...$configurations);
    }
}
