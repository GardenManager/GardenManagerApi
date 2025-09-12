<?php

declare(strict_types=1);

namespace GardenManager\Api\App;

use GardenManager\Api\Core\Infrastructure\Action\ActionAbstract;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\Exception\DefinitionResolverException;
use GardenManager\Api\Core\Infrastructure\Response\Builder\JsonResponseBuilder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class TestAction extends ActionAbstract
{
    public function __construct(
        JsonResponseBuilder $responseBuilder,
        private readonly MessageBusInterface $bus,
    )
    {
        parent::__construct($responseBuilder);
    }


    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $this->bus->dispatch(new TestMessage('hello world'));

        return $this->responseBuilder->setData(['a' => 'b'])->build();
    }
}
