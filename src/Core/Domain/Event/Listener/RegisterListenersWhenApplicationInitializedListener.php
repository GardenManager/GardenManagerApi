<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Domain\Event\Listener;

use GardenManager\Api\Core\Domain\Event\OnApplicationInitializedEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class RegisterListenersWhenApplicationInitializedListener
{
    public function doRegistration(OnApplicationInitializedEvent $event): void
    {
        $container = $event->getContainer();
        $dispatcher = $container->get(EventDispatcher::class);
        $registry = require ROOT_PATH . '/app/events.php';

        foreach ($registry['listeners'] as $eventName => $listenerConfig) {
            $dispatcher->addListener(
                $eventName,
                [
                    $container->get($listenerConfig['class']),
                    $listenerConfig['method']
                ],
                $listenerConfig['priority']
            );
        }

        foreach ($registry['subscribers'] as $subscriberService) {
            $dispatcher->addSubscriber($container->get($subscriberService));
        }
    }
}
