<?php

declare(strict_types=1);

namespace GardenManager\Api\App;

use Doctrine\ORM\EntityManagerInterface;
use GardenManager\Api\App\Entity\Test;
use GardenManager\Api\Core\Infrastructure\Action\ActionAbstract;
use GardenManager\Api\Core\Infrastructure\Response\Builder\JsonResponseBuilder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OrmTestAction extends ActionAbstract
{
    public function __construct(
        JsonResponseBuilder $responseBuilder,
        private readonly EntityManagerInterface $entityManager,
    )
    {
        parent::__construct($responseBuilder);
    }


    public function __invoke(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $entity = $this->entityManager->find(Test::class, 1);

        return $this->responseBuilder->setData($entity)->build();
    }
}
