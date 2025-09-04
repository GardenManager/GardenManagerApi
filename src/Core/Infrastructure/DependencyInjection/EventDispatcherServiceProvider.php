<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\DependencyInjection;

use GardenManager\Api\Core\Domain\Event\Listener\RegisterListenersWhenApplicationInitializedListener;
use GardenManager\Api\Core\Domain\Event\OnApplicationInitializedEvent;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\Contract\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use function DI\get;

class EventDispatcherServiceProvider implements ServiceProviderInterface
{
    public function provide(): array
    {
        return [
            EventDispatcher::class => static function (ContainerInterface $container): EventDispatcher {
                $dispatcher = new EventDispatcher();

                $dispatcher->addListener(
                    OnApplicationInitializedEvent::class,
                    [
                        $container->get(RegisterListenersWhenApplicationInitializedListener::class),
                        'doRegistration'
                    ],
                    -100000
                );

                return $dispatcher;
            },

            EventDispatcherInterface::class => get(EventDispatcher::class),
        ];
    }
}
