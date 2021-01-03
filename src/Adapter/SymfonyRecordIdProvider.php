<?php

declare(strict_types=1);

namespace App\Adapter;

use Mileage\Recording\Domain\Record\RecordId;
use Mileage\Recording\Domain\Record\RecordIdProvider;
use Symfony\Component\Uid\Uuid;

final class SymfonyRecordIdProvider implements RecordIdProvider
{
    public function generate(): RecordId
    {
        return new RecordId((string) Uuid::v4());
    }
}
