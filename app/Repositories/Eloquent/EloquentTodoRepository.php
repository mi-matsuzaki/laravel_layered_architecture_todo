<?php

namespace App\Repositories\Eloquent;

use App\Models\Todo;
use App\Repositories\Interfaces\TodoRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentTodoRepository implements TodoRepositoryInterface
{
    public function __construct(private readonly Todo $model) {}

    public function all(): Collection
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function findById(int $id): Todo
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Todo
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Todo
    {
        $todo = $this->findById($id);
        $todo->update($data);

        return $todo->fresh();
    }

    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }

    public function findByStatus(string $status): Collection
    {
        return $this->model->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
