<?php

declare(strict_types=1);

namespace Mileage\Garage\Application\GetCarsByOwner;

use Mileage\Garage\Domain\Car\Car;
use Mileage\Garage\Domain\Car\CarRepository;
use Mileage\Garage\Domain\Car\OwnerId;

final class GetCarsByOwnerHandler implements GetCarsByOwner
{
    private CarRepository $carRepository;

    public function __construct(CarRepository $carRepository)
    {
        $this->carRepository = $carRepository;
    }

    /**
     * @return array{id:string,name:string,brand:string|null,model:string|null,enabled:bool,license_plate:string}
     */
    private static function toDto(Car $car): array
    {
        return [
            'id' => (string) $car->getId(),
            'name' => (string) $car->getName(),
            'brand' => (string) $car->getBrand(),
            'model' => (string) $car->getModel(),
            'enabled' => $car->isEnabled(),
            'license_plate' => (string) $car->getLicensePlate(),
        ];
    }

    public function handle(GetCarsByOwnerRequest $request, GetCarsByOwnerPresenter $presenter): void
    {
        $ownerId = new OwnerId($request->ownerId);
        $cars = $this->carRepository->getByOwnerId($ownerId);
        $response = new GetCarsByOwnerResponse();
        $response->cars = array_map([__CLASS__, 'toDto'], iterator_to_array($cars));
        $presenter->present($response);
    }
}
