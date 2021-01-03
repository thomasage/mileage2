<?php

namespace Mileage\Recording\Application\AddRecord;

interface AddRecordPresenter
{
    public function present(AddRecordResponse $response): void;
}
