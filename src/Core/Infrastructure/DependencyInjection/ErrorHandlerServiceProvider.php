<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\DependencyInjection;

use GardenManager\Api\Core\Infrastructure\DependencyInjection\Contract\ServiceProviderInterface;
use GardenManager\Api\Core\Infrastructure\ErrorHandler\Handler\MessengerValidationFailedExceptionHandler;
use GardenManager\Api\Core\Infrastructure\ErrorHandler\Renderer\JsonErrorLogRenderer;
use GardenManager\Api\Core\Infrastructure\ErrorHandler\Renderer\JsonResponseErrorRenderer;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Handlers\ErrorHandler;
use Slim\Middleware\ErrorMiddleware;
use Symfony\Component\Messenger\Exception\ValidationFailedException;

class ErrorHandlerServiceProvider implements ServiceProviderInterface
{
    public function provide(): array
    {
        return [
            ErrorMiddleware::class => static function (ContainerInterface $container): ErrorMiddleware {
                $app = $container->get(App::class);

                $errorMiddleware = new ErrorMiddleware(
                    $app->getCallableResolver(),
                    $app->getResponseFactory(),
                    $container->get('config.error_handler.display_error_details'),
                    $container->get('config.error_handler.log_errors'),
                    $container->get('config.error_handler.log_error_details'),
                    $container->get(LoggerInterface::class),
                );

                $errorMiddleware->setErrorHandler(
                    ValidationFailedException::class,
                    MessengerValidationFailedExceptionHandler::class
                );

                /** @var ErrorHandler $errorHandler */
                $errorHandler = $errorMiddleware->getDefaultErrorHandler();

                $errorHandler->registerErrorRenderer('application/json', JsonResponseErrorRenderer::class);
                $errorHandler->setLogErrorRenderer(JsonResponseErrorRenderer::class);

                return $errorMiddleware;
            },
        ];
    }
}
