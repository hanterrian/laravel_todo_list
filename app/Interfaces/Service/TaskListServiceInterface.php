<?php

declare(strict_types=1);

namespace App\Interfaces\Service;

use App\Data\TaskData;
use App\Filters\QueryFilter;
use Illuminate\Http\Request;
use Spatie\LaravelData\DataCollection;

/**
 * Service to operate tasks
 */
interface TaskListServiceInterface
{
    /**
     * Retrieves all items from the tasks list based on the provided filters.
     *
     * @param  QueryFilter  $filter  Query filter.
     * @param  Request  $request  The HTTP request object.
     * @return DataCollection<TaskData> A collection of tasks items that match the provided filters.
     */
    public function getAll(QueryFilter $filter, Request $request): DataCollection;

    /**
     * Retrieves a single task by its ID.
     *
     * @param  int  $id  The ID of the task.
     * @return TaskData      The task object matching the provided ID.
     */
    public function getOne(int $id): TaskData;

    /**
     * Mark a task as done.
     *
     * @param  int  $id  The ID of the task to mark as done.
     * @return bool  Returns true if the task is marked as done successfully,
     *               otherwise returns false.
     */
    public function markAsDone(int $id): bool;

    /**
     * Store a new task in the tasks list.
     *
     * @param  TaskData  $request  The task data to be stored.
     * @return TaskData           The stored task data.
     */
    public function store(TaskData $request): TaskData;

    /**
     * Update a task in the tasks list.
     *
     * @param  int  $id  The ID of the task to be updated.
     * @param  TaskData  $request  The updated task data to be stored.
     * @return TaskData           The updated task data.
     */
    public function update(int $id, TaskData $request): TaskData;

    /**
     * Delete a task from the tasks list.
     *
     * @param  int  $id  The id of the task to be deleted.
     * @return bool   True if the task is successfully deleted, otherwise false.
     */
    public function delete(int $id): bool;
}
