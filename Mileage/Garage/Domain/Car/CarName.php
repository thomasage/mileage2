<?php

declare(strict_types=1);

namespace Mileage\Garage\Domain\Car;

final class CarName implements \Stringable
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
