<?php

namespace App\Repositories\Interfaces;

use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;

interface TodoRepositoryInterface
{
    public function all(): Collection;

    public function findById(int $id): Todo;

    public function create(array $data): Todo;

    public function update(int $id, array $data): Todo;

    public function delete(int $id): void;

    public function findByStatus(string $status): Collection;
}
