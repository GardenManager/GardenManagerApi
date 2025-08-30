<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Domain\Entity\Response;

use GardenManager\Api\Core\Infrastructure\Response\Contract\ResponseMetadataInterface;
use \Throwable;

class ExceptionMetadata implements ResponseMetadataInterface
{
    public function __construct(private readonly Throwable $exception)
    {
    }

    public function getName(): string
    {
        return 'exception';
    }

    public function jsonSerialize(): array
    {
        $trace     = [];
        $exception = $this->exception;

        do {
            $trace[] = $this->formatException($exception);
        } while ($exception = $exception->getPrevious());

        return $trace;
    }

    /**
     * @return array<string, string|int>
     */
    private function formatException(Throwable $exception): array
    {
        return [
            'type'    => get_class($exception),
            'code'    => $exception->getCode(),
            'message' => $exception->getMessage(),
            'file'    => $exception->getFile(),
            'line'    => $exception->getLine(),
            'trace'   => $exception->getTrace(),
        ];
    }
}
