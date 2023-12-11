<?php

declare(strict_types=1);

namespace App\Interfaces\Repository;

use App\Data\TaskData;
use App\Data\TaskFilterData;
use App\Filters\QueryFilter;
use Spatie\LaravelData\DataCollection;

interface TaskListRepositoryInterface
{
    /**
     * @param  QueryFilter  $filter
     * @param  TaskFilterData  $todoFilterDTO
     * @return DataCollection<TaskData>
     */
    public function getTaskList(QueryFilter $filter, TaskFilterData $todoFilterDTO): DataCollection;

    public function getTaskById(int $id): TaskData;

    public function markTaskAsComplete(int $id): bool;

    public function createTask(TaskData $data): TaskData;

    public function updateTask(int $id, TaskData $data): TaskData;

    public function deleteTask(int $id): bool;
}
