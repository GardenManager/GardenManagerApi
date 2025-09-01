<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\App;

use GardenManager\Api\Core\Domain\Event\OnRequestEvent;
use GardenManager\Api\Core\Domain\Event\OnResponseEvent;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\App;
use Slim\Factory\ServerRequestCreatorFactory;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Interfaces\MiddlewareDispatcherInterface;
use Slim\Interfaces\RouteCollectorInterface;
use Slim\Interfaces\RouteResolverInterface;
use Slim\ResponseEmitter;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class EventDispatchingApp extends App
{
    public function __construct(
        private readonly EventDispatcherInterface $eventDispatcher,
        ResponseFactoryInterface $responseFactory,
        ?ContainerInterface $container = null,
        ?CallableResolverInterface $callableResolver = null,
        ?RouteCollectorInterface $routeCollector = null,
        ?RouteResolverInterface $routeResolver = null,
        ?MiddlewareDispatcherInterface $middlewareDispatcher = null
    )
    {
        parent::__construct($responseFactory, $container, $callableResolver, $routeCollector, $routeResolver, $middlewareDispatcher);
    }

    public function run(?ServerRequestInterface $request = null): void
    {
        if (!$request) {
            $serverRequestCreator = ServerRequestCreatorFactory::create();
            $request = $serverRequestCreator->createServerRequestFromGlobals();
        }

        $this->eventDispatcher->dispatch(new OnRequestEvent($request));

        $response = $this->handle($request);

        $this->eventDispatcher->dispatch(new OnResponseEvent($request, $response));

        $responseEmitter = new ResponseEmitter();
        $responseEmitter->emit($response);
    }
}
