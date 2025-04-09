<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

interface IModelService
{
    public function findBy(array $criteria, int $limit): \Illuminate\Pagination\LengthAwarePaginator;

    public function findById(int $id): Collection|Model;

    public function create(array $params): Model;

    public function update(int $id, array $params): Model;

    public function destroy(int $id): bool;
}