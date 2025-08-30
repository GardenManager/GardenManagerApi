<?php

declare(strict_types=1);

namespace GardenManager\Api\Core;

use GardenManager\Api\Core\Domain\Entity\Response\Collection\ResponseMetadataCollection;
use GardenManager\Api\Core\Infrastructure\Container\Contract\ServiceProviderInterface;
use GardenManager\Api\Core\Infrastructure\Response\Builder\JsonResponseBuilder;
use GardenManager\Api\Core\Infrastructure\Response\Contract\ResponseMetadataInterface;
use GardenManager\Api\Core\Infrastructure\Response\Factory\ResponseMetadataFactory;
use Psr\Container\ContainerInterface;

class ResponseBuilderServiceProvider implements ServiceProviderInterface
{
    public function provide(): array
    {
        return [
            ResponseMetadataFactory::class => function (ContainerInterface $container): ResponseMetadataFactory {
                return new ResponseMetadataFactory();
            },

            JsonResponseBuilder::class => function (ContainerInterface $container): JsonResponseBuilder {
                $metadataFactory = $container->get(ResponseMetadataFactory::class);

                $builder = new JsonResponseBuilder(
                    new ResponseMetadataCollection(ResponseMetadataInterface::class, [])
                );

                $builder->addMetadata($metadataFactory->createRequestDataMetadata());

                return $builder;
            },
        ];
    }
}
