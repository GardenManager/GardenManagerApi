<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Domain\Entity\Response;

use GardenManager\Api\Core\Infrastructure\Response\Contract\ResponseMetadataInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UploadedFileInterface;

class RequestDataResponseMetadata implements ResponseMetadataInterface
{
    public function __construct(
        protected readonly ServerRequestInterface $request,
    )
    {
    }

    public function getName(): string
    {
        return 'requestData';
    }

    public function jsonSerialize(): array
    {
        return [
            'body'          => $this->request->getParsedBody(),
            'query'         => $this->request->getQueryParams(),
            'uploadedFiles' => array_map(static function (UploadedFileInterface $uploadedFile): array {
                return [
                    'name' => $uploadedFile->getClientFilename(),
                    'type' => $uploadedFile->getClientMediaType(),
                    'size' => $uploadedFile->getSize(),
                ];
            }, $this->request->getUploadedFiles())
        ];
    }
}
