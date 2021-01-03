<?php

declare(strict_types=1);

namespace Mileage\Garage\Domain\Car;

final class Car
{
    private CarId $id;
    private CarName $name;
    private bool $enabled;
    private ?string $brand;
    private ?string $model;
    private ?string $licensePlate;

    public function __construct(
        CarId $id,
        CarName $name,
        bool $enabled = true,
        ?string $brand = null,
        ?string $model = null,
        ?string $licensePlate = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->enabled = $enabled;
        $this->brand = $brand;
        $this->model = $model;
        $this->licensePlate = $licensePlate;
    }

    public function getId(): CarId
    {
        return $this->id;
    }

    public function getName(): CarName
    {
        return $this->name;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function getLicensePlate(): ?string
    {
        return $this->licensePlate;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
