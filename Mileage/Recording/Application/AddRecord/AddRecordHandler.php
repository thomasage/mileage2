<?php

declare(strict_types=1);

namespace Mileage\Recording\Application\AddRecord;

use Mileage\Recording\Domain\Record\CarId;
use Mileage\Recording\Domain\Record\Record;
use Mileage\Recording\Domain\Record\RecordIdProvider;
use Mileage\Recording\Domain\Record\RecordingService;

final class AddRecordHandler implements AddRecord
{
    private RecordIdProvider $recordIdProvider;
    private RecordingService $service;

    public function __construct(RecordingService $service, RecordIdProvider $recordIdProvider)
    {
        $this->recordIdProvider = $recordIdProvider;
        $this->service = $service;
    }

    public function handle(AddRecordRequest $request, AddRecordPresenter $presenter): void
    {
        $record = new Record(
            $this->recordIdProvider->generate(),
            new CarId($request->carId),
            $request->date,
            $request->mileage
        );
        $this->service->addRecord($record);

        $response = new AddRecordResponse();
        $response->created = true;
        $presenter->present($response);
    }
}
