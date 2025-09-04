<?php

declare(strict_types=1);

namespace GardenManager\Api\App;

use GardenManager\Api\Core\Infrastructure\Action\ActionAbstract;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\Exception\DefinitionResolverException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class TestAction extends ActionAbstract
{
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        throw DefinitionResolverException::becauseInvalidProvider('test::class');

        return $this->responseBuilder->setData(['a' => 'b'])->build();
    }
}
