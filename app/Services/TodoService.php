<?php

namespace App\Services;

use App\Models\Todo;
use App\Repositories\Interfaces\TodoRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TodoService
{
    public function __construct(private readonly TodoRepositoryInterface $todoRepository) {}

    public function getAllTodos(): Collection
    {
        return $this->todoRepository->all();
    }

    public function getTodoById(int $id): Todo
    {
        return $this->todoRepository->findById($id);
    }

    public function createTodo(array $data): Todo
    {
        return $this->todoRepository->create($data);
    }

    public function updateTodo(int $id, array $data): Todo
    {
        return $this->todoRepository->update($id, $data);
    }

    public function deleteTodo(int $id): void
    {
        $this->todoRepository->delete($id);
    }

    public function toggleStatus(int $id): Todo
    {
        $todo = $this->todoRepository->findById($id);
        $newStatus = $todo->isCompleted() ? 'pending' : 'completed';

        return $this->todoRepository->update($id, ['status' => $newStatus]);
    }

    public function getTodosByStatus(string $status): Collection
    {
        return $this->todoRepository->findByStatus($status);
    }
}
