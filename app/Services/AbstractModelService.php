<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Interfaces\IModelService;

abstract class AbstractModelService implements IModelService
{
    protected Model $model;

    public function __construct()
    {
        $this->model = app(static::getModelClass());
    }

    abstract protected static function getModelClass(): string;

    public function findBy(array $criteria, int $limit): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = $this->applyCriteria($this->model->query(), $criteria);
        
        return $query->paginate($limit)->withQueryString();
    }

    public function findById(int $id): Collection|Model
    {
        return $this->model->findOrFail($id);
    }

    protected static function prepareParams(array &$params): void
    {
    }

    protected function syncSubTables($model, array $params): void
    {
    }

    public function create(array $params): Model
    {
        return \DB::transaction(function () use ($params) {
            static::prepareParams($params);

            $createdModel = $this->model->create($params);
            $this->syncSubTables($createdModel, $params);

            return $createdModel;
        });
    }

    public function update(int $id, array $params): Model
    {
        return \DB::transaction(function () use ($id, $params) {
            $model = $this->findById($id);

            static::prepareParams($params);
            $model->update($params);

            $this->syncSubTables($model, $params);

            return $model;
        });
    }

    public function destroy(int $id): bool
    {
        return $this->model->destroy($id);
    }

    protected function applyCriteria($query, array $criteria)
    {
        foreach ($criteria as $column => $value) {
            $query->where($column, $value);
        }

        return $query;
    }
}