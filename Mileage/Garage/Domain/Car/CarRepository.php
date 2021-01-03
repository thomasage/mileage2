<?php

namespace Mileage\Garage\Domain\Car;

interface CarRepository
{
    /**
     * @return \Generator<Car>
     */
    public function getByOwnerId(OwnerId $ownerId): \Generator;
}
