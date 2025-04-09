<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Interfaces\IModelService;

class ResourceController extends Controller
{
    public function __construct(private IModelService $service)
    {
    }

    public function index(): JsonResponse
    {
        $paginatedCollection = $this->service->findBy([], 15);

        return response()->json($paginatedCollection, Response::HTTP_OK);
    }

    public function create(\App\Http\Requests\Resource\CreateRequest $request): JsonResponse
    {
        $model = $this->service->create($request->validated());

        return response()->json($model, Response::HTTP_CREATED);
    }
}