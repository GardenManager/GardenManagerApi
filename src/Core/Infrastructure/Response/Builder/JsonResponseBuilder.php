<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\Response\Builder;

use GardenManager\Api\Core\Domain\Entity\Response\Collection\ResponseMetadataCollection;
use GardenManager\Api\Core\Domain\Entity\Response\Enum\ResponseStatusEnum;
use GardenManager\Api\Core\Domain\Entity\Response\JsonResponse;
use GardenManager\Api\Core\Infrastructure\Response\Contract\ResponseMetadataInterface;
use Psr\Http\Message\ResponseInterface;
use \Throwable;

class JsonResponseBuilder
{
    private mixed $data = null;

    private ?ResponseStatusEnum $status = null;

    private ?int $statusCode = null;

    private ?Throwable $exception = null;

    public function __construct(
        private readonly ResponseMetadataCollection $metadataCollection
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

    public function setException(Throwable $exception): JsonResponseBuilder
    {
        $this->exception = $exception;

        return $this;
    }

    public function addMetadata(ResponseMetadataInterface $metadata): JsonResponseBuilder
    {
        $this->metadataCollection->add($metadata);

        return $this;
    }

    public function build(ResponseInterface $response): ResponseInterface
    {
        return $this->buildEntity()->toResponse($response);
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

        if ($this->exception !== null) {
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

        if ($this->exception !== null) {
            return 500;
        }

        return 200;
    }
}
