<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\IModelService;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    public function __construct(private IModelService $service)
    {
    }

    public function getBookingsByResource(string $id)
    {
        return response()->json($this->service->findBy(['resource_id' => (int) $id], 15), Response::HTTP_OK);
    }

    public function create(\App\Http\Requests\Booking\CreateRequest $request)
    {
        return response()->json($this->service->create($request->validated()), Response::HTTP_CREATED);
    }

    public function destroy(string $id)
    {
        return response()->json($this->service->destroy((int) $id), Response::HTTP_OK);
    }
}
