<?php

declare(strict_types=1);

namespace GardenManager\Api\Infrastructure\Core\Http\Contract;

use Slim\Interfaces\RouteCollectorProxyInterface;

interface RouteProviderInterface
{
    public function provide(RouteCollectorProxyInterface $collector): void;
}
