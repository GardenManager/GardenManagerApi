<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Action;

use GardenManager\Api\Core\Infrastructure\Response\Builder\JsonResponseBuilder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class ActionAbstract
{
    public function __construct(
        protected readonly JsonResponseBuilder $responseBuilder
    )
    {
    }

    abstract public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface;
}
