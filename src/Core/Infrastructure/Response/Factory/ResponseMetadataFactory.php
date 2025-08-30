<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Response\Factory;

use GardenManager\Api\Core\Domain\Entity\Response\ExceptionTraceMetadata;
use GardenManager\Api\Core\Domain\Entity\Response\RequestDataResponseMetadata;
use GardenManager\Api\Core\Infrastructure\Response\Contract\ResponseMetadataInterface;
use Psr\Http\Message\ServerRequestInterface;
use \Throwable;

class ResponseMetadataFactory
{
    private ServerRequestInterface $request;

    public function setRequest(ServerRequestInterface $request): void
    {
        $this->request = $request;
    }

    public function createRequestDataMetadata(): RequestDataResponseMetadata
    {
        return new RequestDataResponseMetadata($this->request);
    }

    public function createExceptionTraceMetadata(Throwable $exception): ExceptionTraceMetadata
    {
        return new ExceptionTraceMetadata($exception);
    }
}
