<?php

declare(strict_types=1);

namespace App\Interfaces\Service;

use App\Data\TaskData;
use App\Filters\QueryFilter;
use Illuminate\Http\Request;
use Spatie\LaravelData\DataCollection;

interface TaskListServiceInterface
{
    public function getAll(QueryFilter $filter, Request $request): DataCollection;

    public function getOne(int $id): TaskData;

    public function markAsDone(int $id): bool;

    public function store(TaskData $request): TaskData;

    public function update(int $id, TaskData $request): TaskData;

    public function delete(int $id): bool;
}
