<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Domain\Entity\Response;

use GardenManager\Api\Core\Domain\Entity\Response\Collection\ResponseMetadataCollection;
use GardenManager\Api\Core\Domain\Entity\Response\Enum\ResponseStatusEnum;
use GardenManager\Api\Core\Infrastructure\Response\Contract\ResponseMetadataInterface;
use JsonSerializable;
use Psr\Http\Message\ResponseInterface;

readonly class JsonResponse implements JsonSerializable
{
    public function __construct(
        private mixed $data,
        private ResponseStatusEnum $status,
        private int $statusCode,
        private ?ResponseMetadataCollection $metadataCollection,
    )
    {
    }

    public function jsonSerialize(): array
    {
        $response = [
            'status' => $this->status->value,
            'data'   => $this->data,
        ];

        if ($this->metadataCollection !== null && !$this->metadataCollection->isEmpty()) {
            /** @var ResponseMetadataInterface $metadata */
            foreach ($this->metadataCollection as $metadata) {
                $response['meta'][$metadata->getName()] = $metadata;
            }
        }

        return $response;
    }

    public function toResponse(ResponseInterface $response): ResponseInterface
    {
        $response->getBody()->write(json_encode($this));

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($this->statusCode);
    }
}
