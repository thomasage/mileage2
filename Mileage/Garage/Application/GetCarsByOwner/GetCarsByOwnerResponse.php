<?php

declare(strict_types=1);

namespace Mileage\Garage\Application\GetCarsByOwner;

final class GetCarsByOwnerResponse
{
    /**
     * @var array<array{id:string,name:string}>
     */
    public array $cars = [];
}
