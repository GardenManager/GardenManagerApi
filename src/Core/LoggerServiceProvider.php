<?php

declare(strict_types=1);

namespace GardenManager\Api\Core;

use GardenManager\Api\Core\Infrastructure\Container\Contract\ServiceProviderInterface;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\PsrLogMessageProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class LoggerServiceProvider implements ServiceProviderInterface
{
    public function provide(): array
    {
        return [
            LoggerInterface::class => static function (ContainerInterface $container): LoggerInterface {
                return new Logger(
                    'default',
                    [
                        new StreamHandler('php://stdout')->setFormatter(new JsonFormatter())
                    ],
                    [
                        new PsrLogMessageProcessor()
                    ]
                );
            },
        ];
    }
}
