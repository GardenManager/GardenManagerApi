<?php

declare(strict_types=1);

namespace GardenManager\Api\App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'test_orm')]
class Test implements \JsonSerializable
{
    #[Id]
    #[Column(type: Types::INTEGER)]
    #[GeneratedValue]
    private int $id;

    #[Column(type: Types::STRING, nullable: true)]
    private string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }


}
