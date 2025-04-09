<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Interfaces\IModelService;
use App\Http\Resources\ResourceJsonResource;

class ResourceController extends Controller
{
    public function __construct(private IModelService $service)
    {
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $paginatedCollection = $this->service->findBy([], 15);

        return ResourceJsonResource::collection($paginatedCollection);
    }

    public function create(\App\Http\Requests\Resource\CreateRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return response()->json(new ResourceJsonResource($model), Response::HTTP_CREATED);
    }
}