<?php

declare(strict_types=1);

namespace Mileage\Recording\Domain\Record;

final class Record
{
    private RecordId $id;
    private CarId $carId;
    private \DateTimeInterface $date;
    private int $mileage;

    public function __construct(RecordId $id, CarId $carId, \DateTimeInterface $date, int $mileage)
    {
        $this->id = $id;
        $this->carId = $carId;
        $this->date = $date;
        $this->mileage = $mileage;
    }

    public function getId(): RecordId
    {
        return $this->id;
    }

    public function getCarId(): CarId
    {
        return $this->carId;
    }

    public function getMileage(): int
    {
        return $this->mileage;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }
}
