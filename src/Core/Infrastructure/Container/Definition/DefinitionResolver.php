<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Container\Definition;

use GardenManager\Api\Core\Infrastructure\Container\Contract\ServiceProviderInterface;
use GardenManager\Api\Core\Infrastructure\Container\Exception\DefinitionResolverException;

readonly class DefinitionResolver
{
    public function __construct(
        private string $providerFile
    )
    {
    }

    public function loadDefinitions(): array
    {
        $providerClasses = $this->getProviderClasses();
        $definitions     = [];

        /** @var ServiceProviderInterface $providerClass */
        foreach ($providerClasses as $providerClass) {
            $provider = new $providerClass();

            if (!$provider instanceof ServiceProviderInterface) {
                DefinitionResolverException::becauseInvalidProvider($provider::class);
            }

            $definitions[] = new $providerClass()->provide();
        }

        return array_merge(...$definitions);
    }

    /**
     * @return string[]
     */
    private function getProviderClasses(): array
    {
        if (!is_file($this->providerFile) || !is_readable($this->providerFile)) {
            throw DefinitionResolverException::becauseProviderFileNotFound($this->providerFile);
        }

        return require $this->providerFile;
    }
}
