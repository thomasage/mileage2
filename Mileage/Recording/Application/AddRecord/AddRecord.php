<?php

namespace Mileage\Recording\Application\AddRecord;

interface AddRecord
{
    public function handle(AddRecordRequest $request, AddRecordPresenter $presenter): void;
}
