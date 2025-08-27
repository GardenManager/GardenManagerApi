<?php

declare(strict_types=1);

use \Exception;

class FrameworkException extends Exception
{
    public function __construct(
        string $message = "",
        private readonly array $context = [],
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
