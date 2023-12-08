<?php

declare(strict_types=1);

namespace App\Interfaces\Service;

use App\DTO\TaskDTO;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use Illuminate\Http\Request;
use Spatie\LaravelData\DataCollection;

interface TaskListServiceInterface
{
    public function getAll(Request $request): DataCollection;

    public function getOne(int $id): TaskDTO;

    public function markAsDone(int $id): bool;

    public function store(CreateTaskRequest $request): TaskDTO;

    public function update(int $id, UpdateTaskRequest $request): TaskDTO;

    public function delete(int $id): bool;
}
