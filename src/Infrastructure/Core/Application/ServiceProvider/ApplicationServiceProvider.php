<?php

declare(strict_types=1);

namespace GardenManager\Api\Infrastructure\Core\Application\ServiceProvider;

use GardenManager\Api\Infrastructure\Core\Container\Contract\ServiceProviderInterface;
use GardenManager\Api\Infrastructure\Core\Http\InvocationStrategy\RouteCallableInvoker;
use Invoker\Invoker;
use Invoker\ParameterResolver\AssociativeArrayResolver;
use Invoker\ParameterResolver\Container\TypeHintContainerResolver;
use Invoker\ParameterResolver\DefaultValueResolver;
use Invoker\ParameterResolver\ResolverChain;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;
use Slim\CallableResolver;
use Slim\Factory\AppFactory;
use Slim\Interfaces\CallableResolverInterface;
use Slim\Interfaces\InvocationStrategyInterface;
use Slim\Interfaces\RouteCollectorInterface;
use Slim\Routing\RouteCollector;
use function DI\autowire;

class ApplicationServiceProvider implements ServiceProviderInterface
{
    public function provide(): array
    {
        return [
            ResponseFactoryInterface::class => autowire(Psr17Factory::class),

            CallableResolverInterface::class => static function(ContainerInterface $container): CallableResolverInterface {
                return new CallableResolver($container);
            },

            RouteCollectorInterface::class => autowire(RouteCollector::class),

            'phpDiInvocationStrategy' => function(ContainerInterface $container): InvocationStrategyInterface {
                $resolvers = [
                    new AssociativeArrayResolver(),
                    new TypeHintContainerResolver($container),
                    new DefaultValueResolver(),
                ];

                $invoker = new Invoker(new ResolverChain($resolvers), $container);

                return new RouteCallableInvoker($invoker);
            },

            App::class => function(ContainerInterface $container): App {
                $app = AppFactory::createFromContainer($container);

                $app->getRouteCollector()->setDefaultInvocationStrategy($container->get('phpDiInvocationStrategy'));

                return $app;
            },
        ];
    }
}
