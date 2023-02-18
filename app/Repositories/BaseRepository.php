<?php

namespace App\Repositories;

use App\Contracts\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    protected Model $model;

    /**
     * BaseRepository constructor.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->with($relations)->get($columns);
    }

    /**
     * Paginate model
     *
     * @return mixed
     */
    public function paginate(int $perPage = 15, array $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Get all trashed models.
     */
    public function allTrashed(): Collection
    {
        return $this->model->onlyTrashed()->get();
    }

    /**
     * Find model by id.
     *
     * @return Model
     */
    public function findById(int $modelId, array $columns = ['*'], array $relations = []): ?Model
    {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId);
    }

    /**
     * Find model by code
     *
     * @return Model
     */
    public function findByCode(string $code, array $columns = ['*'], array $relations = []): ?Model
    {
        return $this->model->select($columns)->with($relations)->where('code', $code)->first();
    }

    /**
     * Find trashed model by id.
     *
     * @return Model
     */
    public function findTrashedById(int $modelId): ?Model
    {
        return $this->model->withTrashed()->findOrFail($modelId);
    }

    /**
     * Find only trashed model by id.
     *
     * @return Model
     */
    public function findOnlyTrashedById(int $modelId): ?Model
    {
        return $this->model->onlyTrashed()->findOrFail($modelId);
    }

    /**
     * Create a model.
     *
     * @return Model
     */
    public function create(array $payload): ?Model
    {
        return $this->model->create($payload);
    }

    /**
     * Creates of finds a user based on some criteria
     *
     * @return Model
     */
    public function firstOrCreate(array $key, array $payload): ?Model
    {
        return $this->model->firstOrCreate($key, $payload);
    }

    /**
     * Update existing model.
     */
    public function update(array $payload, Model $model): ?Model
    {
        $model->update($payload);

        return $model;
    }

    /**
     * Delete model by id.
     */
    public function deleteById(Model $model): bool
    {
        return $model->delete();
    }

    /**
     * Restore model by id.
     */
    public function restoreById(int $modelId): bool
    {
        return $this->findOnlyTrashedById($modelId)->restore();
    }

    /**
     * Permanently delete model by id.
     */
    public function permanentlyDeleteById(int $modelId): bool
    {
        return $this->findTrashedById($modelId)->forceDelete();
    }

    /**
     * return latest records
     *
     * @param int $modelId
     * @return bool
     */
    public function latest(int $rows = 1): Collection
    {
        return $this->model->query()
            ->latest()->take($rows)->get();
    }

    /**
     * search records
     */
    public function search(string $keyword, $searchColumns = [], array $columns = ['*']): Collection
    {
        return $this->model->query()
            ->where(function ($query) use ($keyword, $searchColumns) {
                foreach ($searchColumns as $searchColumn) {
                    $query->orWhere($searchColumn, 'like', '%' . $keyword . '%');
                }
            })->get($columns);
    }

    public function find(string $column, string $value, string $operator = '=', array $columns = ['*'], array $relations = []): ?Model
    {
        return $this->model->query()
            ->with($relations)
            ->where($column, $operator, $value)
            ->first($columns);
    }

    /**
     * Update or create
     */
    public function updateOrCreate(array $whereArray, array $dataArray): ?Model
    {
        if (!empty($whereArray)) {
            $record = $this->model->where($whereArray)->first();
            if ($record !== null) {
                $record->update($dataArray);

                return $record;
            }
        }

        return $this->model->create($dataArray);
    }

    public function updateById(int $modelId, array $payload): ?model
    {
        $record = $this->model->query()->find($modelId);
        $record->update($payload);

        return $record;
    }

    /**
     * Find Where
     */
    public function findWhere(array $whereArray): ?Model
    {
        return $this->model->where($whereArray)->first();
    }
}
