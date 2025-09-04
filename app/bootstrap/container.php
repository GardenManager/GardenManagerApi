<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use GardenManager\Api\Core\Infrastructure\DependencyInjection\Definition\DefinitionResolver;
use Psr\Container\ContainerInterface;

return function(string $providerFile, array $config): ContainerInterface {
    $builder = new ContainerBuilder()
        ->useAttributes(false)
        ->useAutowiring(true);

    $builder->addDefinitions(new DefinitionResolver($providerFile)->loadDefinitions());
    $builder->addDefinitions($config);

    $isDebug = $_ENV['APP_DEBUG'] === 'true';

    if (!$isDebug) {
        $builder->enableCompilation(ROOT_PATH . '/var/cache/container');
    }

    return $builder->build();
};
