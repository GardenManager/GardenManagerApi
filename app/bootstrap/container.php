<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use GardenManager\Api\Infrastructure\Core\Container\Contract\ServiceProviderInterface;

$builder = new ContainerBuilder()
    ->useAttributes(true)
    ->useAutowiring(true);

$providers = require_once ROOT_PATH . '/app/providers.php';

foreach ($providers as $provider) {
    /** @var ServiceProviderInterface $providerObject */
    $providerObject = new $provider();

    $builder->addDefinitions($providerObject->provide());
}

return $builder->build();
