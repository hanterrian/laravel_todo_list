<?php

declare(strict_types=1);

namespace App\Interfaces\Repository;

use App\DTO\TaskDTO;
use App\DTO\TaskFilterDTO;
use App\Filters\QueryFilter;
use Spatie\LaravelData\DataCollection;

interface TaskListRepositoryInterface
{
    /**
     * @param  QueryFilter  $filter
     * @param  TaskFilterDTO  $todoFilterDTO
     * @return DataCollection<TaskDTO>
     */
    public function getTaskList(QueryFilter $filter, TaskFilterDTO $todoFilterDTO): DataCollection;

    public function getTaskById(int $id): TaskDTO;

    public function markTaskAsComplete(int $id): bool;

    public function createTask(TaskDTO $data): TaskDTO;

    public function updateTask(int $id, TaskDTO $data): TaskDTO;

    public function deleteTask(int $id): bool;
}
