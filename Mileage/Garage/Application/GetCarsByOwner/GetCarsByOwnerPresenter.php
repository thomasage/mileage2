<?php

namespace Mileage\Garage\Application\GetCarsByOwner;

interface GetCarsByOwnerPresenter
{
    public function present(GetCarsByOwnerResponse $response): void;
}
