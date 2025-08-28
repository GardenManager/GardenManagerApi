<?php

declare(strict_types=1);

namespace GardenManager\Api\Core;

use GardenManager\Api\Core\Infrastructure\Container\Contract\ServiceProviderInterface;
use GardenManager\Api\Core\Infrastructure\Router\Invoker\RouteCallableInvoker;
use Invoker\Invoker;
use Invoker\ParameterResolver\AssociativeArrayResolver;
use Invoker\ParameterResolver\Container\TypeHintContainerResolver;
use Invoker\ParameterResolver\DefaultValueResolver;
use Invoker\ParameterResolver\NumericArrayResolver;
use Invoker\ParameterResolver\ResolverChain;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Interfaces\InvocationStrategyInterface;
use function DI\autowire;

class HttpApplicationServiceProvider implements ServiceProviderInterface
{
    public function provide(): array
    {
        return [
            ResponseFactoryInterface::class => autowire(Psr17Factory::class),

            InvocationStrategyInterface::class . '.php-di' => function(ContainerInterface $container): InvocationStrategyInterface {
                $resolvers = [
                    new AssociativeArrayResolver(),
                    new TypeHintContainerResolver($container),
                    new DefaultValueResolver(),
                    new NumericArrayResolver(),
                ];

                $invoker = new Invoker(new ResolverChain($resolvers), $container);

                return new RouteCallableInvoker($invoker);
            },

            App::class => function(ContainerInterface $container): App {
                $app = AppFactory::createFromContainer($container);

                $app
                    ->getRouteCollector()
                    ->setDefaultInvocationStrategy(
                        $container->get(InvocationStrategyInterface::class . '.php-di')
                    );

                return $app;
            },
        ];
    }
}
