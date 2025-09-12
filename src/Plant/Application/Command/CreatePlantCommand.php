<?php

declare(strict_types=1);

namespace GardenManager\Api\Plant\Application\Command;

use GardenManager\Api\Plant\Domain\Enum\Lifecycle;
use Symfony\Component\Validator\Constraints as Assert;

class CreatePlantCommand
{
    #[Assert\NotBlank()]
    public string $localName;
    public ?string $genus;
    public ?string $epithet;
    #[Assert\NotBlank()]
    public bool $isHybrid;
    public ?bool $cultivar;
    #[Assert\Choice(callback: [Lifecycle::class, 'getValidValues'])]
    public string $lifecycle;
}
