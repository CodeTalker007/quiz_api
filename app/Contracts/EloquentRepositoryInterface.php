<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{
    /**
     * Get all models
     *
     * @retuns Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Paginate model
     */
    public function paginate(int $perPage = 15, array $columns = ['*']);

    /**
     * Get all trashed models.
     */
    public function allTrashed(): Collection;

    /**
     * Find model by id.
     *
     * @return Model
     */
    public function findById(int $modelId, array $columns = ['*'], array $relations = []): ?Model;

    /**
     * Find model by code
     *
     * @return Model
     */
    public function findByCode(string $code, array $columns = ['*'], array $relations = []): ?Model;

    /**
     * Find trashed model by id.
     *
     * @return Model
     */
    public function findTrashedById(int $modelId): ?Model;

    /**
     * Create a model.
     *
     * @return Model
     */
    public function create(array $payload): ?Model;

    /**
     * Creates of finds a user based on some criteria
     *
     * @return Model
     */
    public function firstOrCreate(array $key, array $payload): ?Model;

    /**
     * Update existing model.
     *
     * @return Model
     */
    public function update(array $payload, Model $model): ?Model;

    /**
     * Delete model by id.
     */
    public function deleteById(Model $model): bool;

    /**
     * Restore model by id.
     */
    public function restoreById(int $modelId): bool;

    /**
     * Permanently delete model by id.
     */
    public function permanentlyDeleteById(int $modelId): bool;

    /**
     * Update or create
     */
    public function updateOrCreate(array $whereArray, array $dataArray): ?Model;

    public function updateById(int $modelId, array $payload): ?Model;

    /**
     * Find Where
     */
    public function findWhere(array $whereArray): ?Model;
}
