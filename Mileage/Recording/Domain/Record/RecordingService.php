<?php

declare(strict_types=1);

namespace Mileage\Recording\Domain\Record;

final class RecordingService
{
    private RecordRepository $recordRepository;

    public function __construct(RecordRepository $recordRepository)
    {
        $this->recordRepository = $recordRepository;
    }

    public function addRecord(Record $record): void
    {
        $this->recordRepository->save($record);
    }
}
