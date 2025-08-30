<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Domain\Entity\Response;

use GardenManager\Api\Core\Infrastructure\Response\Contract\ResponseMetadataInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class ResponseMetadataAbstract implements ResponseMetadataInterface
{
    public function __construct(
        protected readonly ServerRequestInterface $request,
    )
    {
    }
}
