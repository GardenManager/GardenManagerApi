<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Response\Middleware;

use GardenManager\Api\Core\Infrastructure\Response\Factory\ResponseMetadataFactory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Add the current request context to the metadata builder
 */
class ResponseMetadataFactoryMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly ResponseMetadataFactory $responseMetadataFactory
    )
    {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->responseMetadataFactory->setRequest($request);

        return $handler->handle($request);
    }
}
