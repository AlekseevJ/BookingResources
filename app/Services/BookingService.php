<?php 

namespace App\Services;

class BookingService extends AbstractModelService
{
    protected static function getModelClass(): string
    {
        return \App\Models\Booking::class;
    }
}