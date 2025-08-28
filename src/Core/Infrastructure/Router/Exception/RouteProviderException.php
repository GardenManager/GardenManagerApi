<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Router\Exception;

use GardenManager\Api\Core\Domain\Exception\Contract\FrameworkException;
use GardenManager\Api\Core\Infrastructure\Router\Contract\RouteProviderInterface;

class RouteProviderException extends FrameworkException
{
    public static function becauseNoFilesAreLoaded(string $location): self
    {
        return new self('No routing files were found.',
            [
                'path' => $location,
            ]
        );
    }

    public static function becauseInvalidProvider(string $file): self
    {
        return new self(
            'Route file must return a class that implements ' . RouteProviderInterface::class,
            [
                'file' => $file,
            ]
        );
    }
}
