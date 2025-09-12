<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\ErrorHandler\Handler;

use GardenManager\Api\Core\Domain\Entity\Response\Enum\ResponseStatusEnum;
use GardenManager\Api\Core\Infrastructure\Response\Builder\JsonResponseBuilder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Interfaces\ErrorHandlerInterface;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

class MessengerValidationFailedExceptionHandler implements ErrorHandlerInterface
{
    public function __construct(
        private readonly JsonResponseBuilder $responseBuilder,
    )
    {
    }

    public function __invoke(
        ServerRequestInterface $request,
        Throwable|ValidationFailedException $exception,
        bool $displayErrorDetails,
        bool $logErrors,
        bool $logErrorDetails
    ): ResponseInterface
    {
        return $this
            ->responseBuilder
            ->setStatusCode(400)
            ->setStatus(ResponseStatusEnum::FAILED)
            ->setData($this->formatViolations($exception->getViolations()))
            ->build();
    }

    private function formatViolations(ConstraintViolationListInterface $violations): array
    {
        $formattedViolations = [];

        foreach ($violations as $violation) {
            $formattedViolations[] = [
                'message' => $violation->getMessage(),
                'field' => $violation->getPropertyPath(),
                'code' => $violation->getCode(),
            ];
        }

        return $formattedViolations;
    }
}
