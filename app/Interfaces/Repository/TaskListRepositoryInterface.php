<?php

declare(strict_types=1);

namespace App\Interfaces\Repository;

use App\Data\TaskData;
use App\Data\TaskFilterData;
use App\Filters\QueryFilter;
use Spatie\LaravelData\DataCollection;

/**
 * Task list repository interface
 */
interface TaskListRepositoryInterface
{
    /**
     * Get all tasks
     *
     * @param  QueryFilter  $filter
     * @param  TaskFilterData  $todoFilterDTO
     * @return DataCollection<TaskData>
     */
    public function getTaskList(QueryFilter $filter, TaskFilterData $todoFilterDTO): DataCollection;

    /**
     * Get task by id
     *
     * @param  int  $id
     * @return TaskData
     */
    public function getTaskById(int $id): TaskData;

    /**
     * Complete the task
     *
     * @param  int  $id
     * @return bool
     */
    public function markTaskAsComplete(int $id): bool;

    /**
     * Create new task
     *
     * @param  TaskData  $data
     * @return TaskData
     */
    public function createTask(TaskData $data): TaskData;

    /**
     * Update the task
     *
     * @param  int  $id
     * @param  TaskData  $data
     * @return TaskData
     */
    public function updateTask(int $id, TaskData $data): TaskData;

    /**
     * Delete the task
     *
     * @param  int  $id
     * @return bool
     */
    public function deleteTask(int $id): bool;
}
