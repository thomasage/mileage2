<?php

namespace Mileage\Recording\Domain\Record;

interface RecordRepository
{
    /**
     * @return \Generator<Record>
     */
    public function getByCar(CarId $carId): \Generator;

    public function save(Record $record): void;
}
