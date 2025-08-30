<?php

declare(strict_types=1);

use GardenManager\Api\App\TestAction;
use GardenManager\Api\Core\Infrastructure\Router\Contract\RouteProviderInterface;
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

        $collector->get(
            '/hello/{word}',
            function (
                ServerRequestInterface $request,
                ResponseInterface $response,
                string $word,
            ): ResponseInterface {
                $response->getBody()->write('Hello, ' . $word . '!' );

                return $response;
            }
        );

        $collector->get('/action', TestAction::class);
    }
};
