<?php

declare(strict_types=1);

namespace GardenManager\Api\Location\Domain\Entity;

use Carbon\Carbon;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Bridge\Doctrine\Types\UlidType;

//#[Entity]
class Location
{
    #[Id]
    #[Column(type: UlidType::NAME, unique: true)]
    #[GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: UlidGenerator::class)]
    private ?int $id;


    private string $country;

    private string $county;

    private string $city;

    private string $street;

    private string $houseNumber;

    #[Column(type: 'datetime')]
    private Carbon $createdAt;

    #[Column(type: 'datetime')]
    private ?Carbon $updatedAt;

    #[Column(type: 'datetime')]
    private ?Carbon $deletedAt;
}
