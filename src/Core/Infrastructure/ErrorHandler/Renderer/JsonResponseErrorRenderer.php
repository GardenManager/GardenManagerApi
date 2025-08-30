<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\ErrorHandler\Renderer;

use GardenManager\Api\Core\Domain\Entity\Response\Enum\ResponseStatusEnum;
use GardenManager\Api\Core\Infrastructure\Response\Builder\JsonResponseBuilder;
use GardenManager\Api\Core\Infrastructure\Response\Factory\ResponseMetadataFactory;
use Slim\Error\AbstractErrorRenderer;
use Throwable;

class JsonResponseErrorRenderer extends AbstractErrorRenderer
{
    public function __construct(
        private readonly JsonResponseBuilder $responseBuilder,
        private readonly ResponseMetadataFactory $responseMetadataFactory,
    )
    {
    }

    public function __invoke(Throwable $exception, bool $displayErrorDetails): string
    {
        return json_encode(
            $this
                ->responseBuilder
                ->setStatus(ResponseStatusEnum::ERROR)
                ->setData($exception->getMessage())
                ->setException($exception)
                ->addMetadata(
                    $this->responseMetadataFactory->createExceptionMetadata($exception, $displayErrorDetails)
                )
                ->buildEntity(),
            JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR
        );
    }
}
