<?php

declare(strict_types=1);

namespace App\Interfaces\Service;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface TaskListServiceInterface
{
    public function getAll(Request $request): Collection;

    public function getOne(int $id): Task;

    public function markAsDone(int $id): bool;

    public function store(Request $request): Task;

    public function update(int $id, Request $request): Task;

    public function delete(int $id): bool;
}
