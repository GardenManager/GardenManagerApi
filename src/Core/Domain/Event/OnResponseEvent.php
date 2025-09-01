<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Domain\Event;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Contracts\EventDispatcher\Event;

class OnResponseEvent extends Event
{
    public function __construct(
        private readonly ServerRequestInterface $request,
        private readonly ResponseInterface $response,
    )
    {
    }

    public function getRequest(): ServerRequestInterface
    {
        return $this->request;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
