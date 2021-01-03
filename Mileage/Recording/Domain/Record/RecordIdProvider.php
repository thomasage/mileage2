<?php

namespace Mileage\Recording\Domain\Record;

interface RecordIdProvider
{
    public function generate(): RecordId;
}
