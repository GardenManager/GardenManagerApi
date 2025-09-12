<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Response\Builder;

use GardenManager\Api\Core\Domain\Entity\Response\Collection\ResponseMetadataCollection;
use GardenManager\Api\Core\Domain\Entity\Response\Enum\ResponseStatusEnum;
use GardenManager\Api\Core\Domain\Entity\Response\ExceptionMetadata;
use GardenManager\Api\Core\Domain\Entity\Response\JsonResponse;
use GardenManager\Api\Core\Infrastructure\Response\Contract\ResponseMetadataInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;

class JsonResponseBuilder
{
    private mixed $data = null;

    private ?ResponseStatusEnum $status = null;

    private ?int $statusCode = null;

    public function __construct(
        private readonly ResponseMetadataCollection $metadataCollection,
        private readonly ResponseFactoryInterface $responseFactory,
    )
    {
    }

    public function setData(mixed $data): JsonResponseBuilder
    {
        $this->data = $data;

        return $this;
    }

    public function setStatus(ResponseStatusEnum $status): JsonResponseBuilder
    {
        $this->status = $status;

        return $this;
    }

    public function setStatusCode(int $statusCode): JsonResponseBuilder
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function addMetadata(ResponseMetadataInterface $metadata): JsonResponseBuilder
    {
        $this->metadataCollection->add($metadata);

        return $this;
    }

    public function build(): ResponseInterface
    {
        return $this
            ->buildEntity()
            ->toResponse(
                $this
                    ->responseFactory
                    ->createResponse()
            );
    }

    public function buildEntity(): JsonResponse
    {
        return new JsonResponse(
            $this->data,
            $this->determineStatus(),
            $this->determineStatusCode(),
            $this->metadataCollection,
        );
    }

    private function determineStatus(): ResponseStatusEnum
    {
        if ($this->status !== null) {
            return $this->status;
        }

        if ($this->hasExceptionMetadata($this->metadataCollection)) {
            return ResponseStatusEnum::ERROR;
        }

        return ResponseStatusEnum::SUCCESS;
    }

    private function determineStatusCode(): int
    {
        if ($this->statusCode !== null) {
            return $this->statusCode;
        }

        if ($this->determineStatus() === ResponseStatusEnum::SUCCESS) {
            if ($this->data === null) {
                return 204;
            }

            return 200;
        }

        if ($this->determineStatus() === ResponseStatusEnum::FAILED) {
            return 400;
        }

        if ($this->hasExceptionMetadata($this->metadataCollection)) {
            return 500;
        }

        return 200;
    }

    private function hasExceptionMetadata(ResponseMetadataCollection $metadataCollection): bool
    {
        return $metadataCollection
                ->filter(
                    fn(ResponseMetadataInterface $item) => $item instanceof ExceptionMetadata
                )
                ->count() > 0;
    }
}
