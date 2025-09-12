<?php

declare(strict_types=1);

namespace GardenManager\Api\Plant\Domain\Entity;

use Carbon\Carbon;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use GardenManager\Api\Plant\Domain\Enum\Lifecycle;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Bridge\Doctrine\Types\UlidType;

#[Entity]
#[Table(name: 'plant')]
class Plant
{
    #[Id]
    #[Column(type: UlidType::NAME, unique: true)]
    #[GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: UlidGenerator::class)]
    private ?int $id;

    #[Column(type: 'string', length: 64)]
    private string $localName;

    #[Column(type: 'string', length: 32, nullable: true)]
    private string $genus;

    #[Column(type: 'string', length: 32, nullable: true)]
    private string $epithet;

    #[Column(type: 'boolean')]
    private bool $isHybrid;

    #[Column(type: 'string', length: 64, nullable: true)]
    private string $cultivar;

    #[Column(type: 'string', length: 16, enumType: Lifecycle::class)]
    private Lifecycle $lifecycle;

    #[Column(type: 'datetime')]
    private Carbon $createdAt;

    #[Column(type: 'datetime', nullable: true)]
    private ?Carbon $updatedAt;

    #[Column(type: 'datetime', nullable: true)]
    private ?Carbon $deletedAt;
}
