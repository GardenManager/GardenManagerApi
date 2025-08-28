<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Router\Contract;

use Slim\Interfaces\RouteCollectorProxyInterface;

interface RouteProviderInterface
{
    public function provide(RouteCollectorProxyInterface $collector): void;
}
