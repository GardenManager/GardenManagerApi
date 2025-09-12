<?php

declare(strict_types=1);

namespace GardenManager\Api\Seller\Domain\Entity;

use Carbon\Carbon;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use GardenManager\Api\Location\Domain\Entity\Location;
use GardenManager\Api\Seller\Domain\Enum\SellerType;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Bridge\Doctrine\Types\UlidType;

//#[Entity]
class Seller
{
    #[Id]
    #[Column(type: UlidType::NAME, unique: true)]
    #[GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: UlidGenerator::class)]
    private ?int $id;

    #[Column(type: 'string', enumType: SellerType::class)]
    private SellerType $type;

    #[ManyToOne(targetEntity: Location::class)]
    #[JoinColumn(name: 'location_id', referencedColumnName: 'id')]
    private ?Location $location = null;

    #[Column(type: 'datetime')]
    private Carbon $createdAt;

    #[Column(type: 'datetime')]
    private ?Carbon $updatedAt;

    #[Column(type: 'datetime')]
    private ?Carbon $deletedAt;
}
