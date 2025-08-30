<?php

declare(strict_types=1);

namespace GardenManager\Api\Core;

use GardenManager\Api\Core\Infrastructure\Container\Contract\ServiceProviderInterface;
use GardenManager\Api\Core\Infrastructure\ErrorHandler\Renderer\JsonResponseErrorRenderer;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Middleware\ErrorMiddleware;

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
                );

                $errorMiddleware->getDefaultErrorHandler()->registerErrorRenderer('application/json', JsonResponseErrorRenderer::class);
                $errorMiddleware->getDefaultErrorHandler()->forceContentType('application/json');

                return $errorMiddleware;
            },
        ];
    }
}
