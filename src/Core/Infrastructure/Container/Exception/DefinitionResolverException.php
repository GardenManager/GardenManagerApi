<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Container\Exception;

use GardenManager\Api\Core\Domain\Exception\Contract\FrameworkException;
use GardenManager\Api\Core\Infrastructure\Container\Contract\ServiceProviderInterface;

class DefinitionResolverException extends FrameworkException
{
    public static function becauseProviderFileNotFound(string $location): self
    {
        return new self('The main service provider file not found!',
            [
                'path' => $location,
            ]
        );
    }

    public static function becauseInvalidProvider(string $providerClass): self
    {
        return new self(
            sprintf(
                'Service %s provider classes must implement %s',
                $providerClass,
                ServiceProviderInterface::class,
            ),
            [
                'class' => $providerClass,
            ]
        );
    }
}
