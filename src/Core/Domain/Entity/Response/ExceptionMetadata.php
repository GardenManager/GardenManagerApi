<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Domain\Entity\Response;

use GardenManager\Api\Core\Domain\Exception\Contract\FrameworkException;
use GardenManager\Api\Core\Infrastructure\Response\Contract\ResponseMetadataInterface;
use \Throwable;

class ExceptionMetadata implements ResponseMetadataInterface
{
    public function __construct(
        private readonly Throwable $exception,
        private readonly bool $displayErrorDetails,
    )
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
     * @return array<string, int|list<array<string, array<mixed>|int|object|string>>|string>
     */
    private function formatException(Throwable $exception): array
    {
        $formattedException = [
            'type'    => get_class($exception),
            'code'    => $exception->getCode(),
            'file'    => $exception->getFile(),
            'line'    => $exception->getLine(),
        ];

        if ($exception instanceof FrameworkException) {
            $formattedException['context'] = $exception->getContext();
        }

        if ($this->displayErrorDetails) {
            $formattedException['trace'] = $exception->getTrace();
        }

        return $formattedException;
    }
}
