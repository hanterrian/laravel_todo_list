<?php

declare(strict_types=1);

namespace App\Interfaces\Service;

use App\DTO\TaskDTO;
use App\Filters\QueryFilter;
use Illuminate\Http\Request;
use Spatie\LaravelData\DataCollection;

interface TaskListServiceInterface
{
    public function getAll(QueryFilter $filter, Request $request): DataCollection;

    public function getOne(int $id): TaskDTO;

    public function markAsDone(int $id): bool;

    public function store(TaskDTO $request): TaskDTO;

    public function update(int $id, TaskDTO $request): TaskDTO;

    public function delete(int $id): bool;
}
