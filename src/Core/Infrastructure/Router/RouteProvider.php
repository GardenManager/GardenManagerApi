<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Router;

use DirectoryIterator;
use GardenManager\Api\Core\Infrastructure\Router\Contract\RouteProviderInterface;
use GardenManager\Api\Infrastructure\Core\Http\RouteProviderException;
use Slim\Interfaces\RouteCollectorProxyInterface;

class RouteProvider
{
    /**
     * @param string $routePath The path where route file are stored
     */
    public function __construct(
        private readonly string $routePath
    )
    {
    }

    public function load(RouteCollectorProxyInterface $routeCollector): void
    {
        $routeFiles = $this->getRouteFilesInDirectory();

        foreach ($routeFiles as $routeFile) {
            $this->tryLoad($routeFile, $routeCollector);
        }
    }

    private function getRouteFilesInDirectory(): array
    {
        $routeFiles     = new DirectoryIterator($this->routePath);
        $collectedFiles = [];

        foreach ($routeFiles as $routeFile) {
            if ($routeFile->isFile() && $routeFile->getExtension() === 'php') {
                $collectedFiles[] = $routeFile->getRealPath();
            }
        }

        if (empty($collectedFiles)) {
            throw RouteProviderException::becauseNoFilesAreLoaded($this->routePath);
        }

        return $collectedFiles;
    }

    private function tryLoad(string $routeFile, RouteCollectorProxyInterface $routeCollector): void
    {
        /** @var RouteProviderInterface $providerObject */
        $providerObject = require $routeFile;

        if (!$providerObject instanceof RouteProviderInterface) {
            throw RouteProviderException::becauseInvalidProvider($routeFile);
        }

        $providerObject->provide($routeCollector);
    }
}
