<?php

namespace App\Enums;

use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\BookingController;
use App\Services\BookingService;
use App\Services\ResourceService;

enum ServiceBinding: string
{
    case BOOKING = BookingController::class . ':' . BookingService::class;
    case RESOURCE = ResourceController::class . ':' . ResourceService::class;

    public function getControllerClass(): string
    {
        return explode(':', $this->value)[0];
    }

    public function getServiceClass(): string
    {
        return explode(':', $this->value)[1];
    }
}