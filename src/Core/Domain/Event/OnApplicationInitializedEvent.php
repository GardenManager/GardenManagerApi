<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Domain\Event;

use Psr\Container\ContainerInterface;
use Slim\App;
use Symfony\Contracts\EventDispatcher\Event;

class OnApplicationInitializedEvent extends Event
{
    public function __construct(
        private readonly App $app,
        private readonly ContainerInterface $container,
    )
    {
    }

    public function getApp(): App
    {
        return $this->app;
    }

    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }
}
