<?php

declare(strict_types=1);

namespace GardenManager\Api\Plant\Presentation\Web\Action;

use GardenManager\Api\Core\Infrastructure\Action\ActionAbstract;
use GardenManager\Api\Core\Infrastructure\Response\Builder\JsonResponseBuilder;
use GardenManager\Api\Plant\Application\Command\CreatePlantCommand;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Serializer\SerializerInterface;

class CreatePlantAction extends ActionAbstract
{
    public function __construct(
        JsonResponseBuilder $responseBuilder,
        private readonly MessageBusInterface $messageBus,
        private readonly SerializerInterface $serializer,
    )
    {
        parent::__construct($responseBuilder);
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface
    {
        $message = $this->serializer->denormalize(
            array_merge(
                $request->getParsedBody() ?? [],
                $request->getQueryParams() ?? [],
                $request->getAttributes() ?? [],
            ),
            CreatePlantCommand::class
        );

        $this->messageBus->dispatch($message);
    }
}
