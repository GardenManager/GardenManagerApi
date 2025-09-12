<?php

declare(strict_types=1);

use GardenManager\Api\Core\Infrastructure\Router\Contract\RouteProviderInterface;
use GardenManager\Api\Plant\Presentation\Web\Action\CreatePlantAction;
use Slim\Interfaces\RouteCollectorProxyInterface;

return new class implements RouteProviderInterface
{
    public function provide(RouteCollectorProxyInterface $collector): void
    {
        $collector->group('/v1', function (RouteCollectorProxyInterface $collector): void {
            $collector->group('/plant', function (RouteCollectorProxyInterface $collector): void {
                $collector->post('', CreatePlantAction::class);
            });
        });
    }
};
