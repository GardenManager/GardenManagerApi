<?php

declare(strict_types=1);

namespace GardenManager\Api\Seller\Domain\Enum;

enum SellerType: string
{
    case PRIVATE_PERSON = 'private_person';
    case BUSINESS = 'business';
    case PRODUCER = 'producer';
}
