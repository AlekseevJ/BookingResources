<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\IModelService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\BookingResource;

class BookingController extends Controller
{
    public function __construct(private IModelService $service)
    {
    }

    public function getBookingsByResource(string $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $paginatedCollection = $this->service->findBy(['resource_id' => (int) $id], 15);

        return BookingResource::collection($paginatedCollection);
    }

    public function create(\App\Http\Requests\Booking\CreateRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return response()->json(new BookingResource($model), Response::HTTP_CREATED);
    }

    public function destroy(string $id): JsonResponse
    {
        return response()->json($this->service->destroy((int) $id), Response::HTTP_OK);
    }
}
