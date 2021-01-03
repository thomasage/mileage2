<?php

namespace Mileage\Garage\Application\GetCarsByOwner;

interface GetCarsByOwner
{
    public function handle(GetCarsByOwnerRequest $request, GetCarsByOwnerPresenter $presenter): void;
}
