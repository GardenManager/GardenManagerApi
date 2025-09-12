<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\DependencyInjection;

use GardenManager\Api\Core\Infrastructure\DependencyInjection\Contract\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Messenger\Middleware\ValidationMiddleware;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MessengerServiceProvider implements ServiceProviderInterface
{
    public function provide(): array
    {
        return [
            MessageBusInterface::class => static function (ContainerInterface $container): MessageBusInterface {
                $handlerConfig = require ROOT_PATH . '/app/handlers.php';
                $handlers = [];

                foreach ($handlerConfig as $messageClass => $handlerClasses) {
                    foreach ($handlerClasses as $handlerClass) {
                        $handlers[$messageClass][] = $container->get($handlerClass);
                    }
                }

                $handlerLocator = new HandlersLocator($handlers);

                return new MessageBus(
                    [
                        new ValidationMiddleware($container->get(ValidatorInterface::class)),
                        new HandleMessageMiddleware($handlerLocator)
                    ]
                );
            }
        ];
    }
}
