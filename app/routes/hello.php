<?php

declare(strict_types=1);

use GardenManager\Api\Infrastructure\Core\Http\Contract\RouteProviderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\RouteCollectorProxyInterface;

return new class implements RouteProviderInterface {
    public function provide(RouteCollectorProxyInterface $collector): void
    {
        $collector->get(
            '/',
            function (
                ServerRequestInterface $request,
                ResponseInterface $response
            ): ResponseInterface {
                $response->getBody()->write('Hello!');

                return $response;
            }
        );
    }
};
