<?php

declare(strict_types=1);

namespace GardenManager\Api\Core\Infrastructure\DependencyInjection;

use GardenManager\Api\Core\Infrastructure\DependencyInjection\Contract\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\PropertyInfo\Extractor\ConstructorExtractor;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerServiceProvider implements ServiceProviderInterface
{
    public function provide(): array
    {
        return [
            SerializerInterface::class => static function (ContainerInterface $container): SerializerInterface {
                return new Serializer(
                    [
                        new BackedEnumNormalizer(),
                        new ObjectNormalizer(
                            classMetadataFactory: new ClassMetadataFactory(new AttributeLoader()),
                            nameConverter: new CamelCaseToSnakeCaseNameConverter(),
                            propertyTypeExtractor: new PropertyInfoExtractor(
                                typeExtractors: [
                                    new ConstructorExtractor(),
                                    new ReflectionExtractor(),
                                    new PhpDocExtractor()
                                ]
                            )
                        )
                    ]
                );
            }
        ];
    }
}
