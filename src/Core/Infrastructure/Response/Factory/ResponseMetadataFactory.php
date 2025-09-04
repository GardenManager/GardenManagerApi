<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Response\Factory;

use GardenManager\Api\Core\Domain\Entity\Response\ExceptionMetadata;
use GardenManager\Api\Core\Domain\Entity\Response\RequestDataResponseMetadata;
use Psr\Http\Message\ServerRequestInterface;
use \Throwable;

class ResponseMetadataFactory
{
    public ServerRequestInterface $request {
        set(ServerRequestInterface $value) {
            $this->request = $value;
        }
    }

    public function createRequestDataMetadata(): RequestDataResponseMetadata
    {
        return new RequestDataResponseMetadata($this->request);
    }

    public function createExceptionMetadata(Throwable $exception, bool $displayErrorDetails): ExceptionMetadata
    {
        return new ExceptionMetadata($exception, $displayErrorDetails);
    }
}
