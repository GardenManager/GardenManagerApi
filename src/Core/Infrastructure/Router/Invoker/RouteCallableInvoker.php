<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Router\Invoker;

use Invoker\InvokerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\InvocationStrategyInterface;

class RouteCallableInvoker implements InvocationStrategyInterface
{
    public function __construct(
        private readonly InvokerInterface $invoker
    )
    {
    }

    public function __invoke(
        callable $callable,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $routeArguments
    ): ResponseInterface
    {
        $parameters              = [
            'request'  => $this->injectRouteArguments($request, $routeArguments),
            'response' => $response,
        ];
        $parameters['args']      = $routeArguments;
        $parameters['arguments'] = $routeArguments;
        $parameters              += $routeArguments;
        $parameters              += $request->getAttributes();

        return $this->invoker->call($callable, $parameters);
    }

    private function injectRouteArguments(
        ServerRequestInterface $request,
        array $routeArguments
    ): ServerRequestInterface
    {
        foreach ($routeArguments as $key => $value) {
            $request = $request->withAttribute($key, $value);
        }

        return $request
            ->withAttribute('args', $routeArguments)
            ->withAttribute('arguments', $routeArguments);
    }
}
