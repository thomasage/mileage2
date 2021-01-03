<?php

declare(strict_types=1);

namespace Mileage\Recording\Application\AddRecord;

final class AddRecordRequest
{
    public string $carId;
    public \DateTimeInterface $date;
    public int $mileage;
}
