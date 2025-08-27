<?php

declare(strict_types=1);

use GardenManager\Api\Infrastructure\Core\Http\Contract\RouteProviderInterface;

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
