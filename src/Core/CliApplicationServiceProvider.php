<?php

declare(strict_types=1);

namespace GardenManager\Api\Core;

use GardenManager\Api\Core\Infrastructure\Container\Contract\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use function DI\autowire;

class CliApplicationServiceProvider implements ServiceProviderInterface
{
    public function provide(): array
    {
        return [
            ContainerCommandLoader::class => autowire(ContainerCommandLoader::class)
                ->constructorParameter('commandMap', require ROOT_PATH . '/app/commands.php'),

            Application::class => static function(ContainerInterface $container): Application {
                $application = new Application(
                    $container->get('config.cli.application_name'),
                    $container->get('config.cli.application_version')
                );

                $application->setCommandLoader($container->get(ContainerCommandLoader::class));

                return $application;
            },
        ];
    }
}
