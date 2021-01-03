<?php

declare(strict_types=1);

namespace App\PrivateArea\Car;

use Mileage\Garage\Application\GetCarsByOwner\GetCarsByOwnerPresenter;
use Mileage\Garage\Application\GetCarsByOwner\GetCarsByOwnerResponse;

final class CarIndexHtmlPresenter implements GetCarsByOwnerPresenter
{
    private CarIndexHtmlViewModel $viewModel;

    public function __construct()
    {
        $this->viewModel = new CarIndexHtmlViewModel();
    }

    /**
     * @param array{id:string,name:string,brand:string|null,model:string|null,enabled:bool,license_plate:string} $car
     *
     * @return array{id:string,name:string,brand:string|null,model:string|null,enabled:bool,license_plate:string}
     */
    private static function toDto(array $car): array
    {
        return $car;
    }

    public function present(GetCarsByOwnerResponse $response): void
    {
        $this->viewModel->cars = array_map([__CLASS__, 'toDto'], $response->cars);
    }

    public function getViewModel(): CarIndexHtmlViewModel
    {
        return $this->viewModel;
    }
}
