<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Domain\Event;

use Psr\Http\Message\ServerRequestInterface;
use Symfony\Contracts\EventDispatcher\Event;

class OnRequestEvent extends Event
{
    public function __construct(
        private readonly ServerRequestInterface $request
    )
    {
    }

    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }
}
