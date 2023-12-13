<?php

declare(strict_types=1);

namespace App\Services;

use App\Data\TaskData;
use App\Data\TaskFilterData;
use App\Filters\QueryFilter;
use App\Interfaces\Repository\TaskListRepositoryInterface;
use App\Interfaces\Service\TaskListServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelData\DataCollection;

/**
 * Class TaskListService
 *
 * The TaskListService class provides methods to interact with the tasks list
 */
class TaskListService implements TaskListServiceInterface
{
    /**
     * Constructs a new instance of the class.
     *
     * @param  TaskListRepositoryInterface  $todoListRepository  The repository used to access the tasks list.
     */
    public function __construct(
        private readonly TaskListRepositoryInterface $todoListRepository
    ) {
    }

    /**
     * Retrieves all items from the tasks list based on the provided filters.
     *
     * @param  QueryFilter  $filter  Query filter.
     * @param  Request  $request  The HTTP request object.
     * @return DataCollection<TaskData> A collection of tasks items that match the provided filters.
     */
    public function getAll(QueryFilter $filter, Request $request): DataCollection
    {
        return $this->todoListRepository->getTaskList($filter, TaskFilterData::from($request));
    }

    /**
     * Retrieves a single task by its ID.
     *
     * @param  int  $id  The ID of the task.
     * @return TaskData      The task object matching the provided ID.
     */
    public function getOne(int $id): TaskData
    {
        return $this->todoListRepository->getTaskById($id);
    }

    /**
     * Mark a task as done.
     *
     * @param  int  $id  The ID of the task to mark as done.
     * @return bool  Returns true if the task is marked as done successfully,
     *               otherwise returns false.
     * @throws ValidationException  If the task has uncompleted subtasks.
     */
    public function markAsDone(int $id): bool
    {
        return $this->todoListRepository->markTaskAsComplete($id);
    }

    /**
     * Store a new task in the tasks list.
     *
     * @param  TaskData  $request  The task data to be stored.
     * @return TaskData           The stored task data.
     */
    public function store(TaskData $request): TaskData
    {
        return $this->todoListRepository->createTask($request);
    }

    /**
     * Update a task in the tasks list.
     *
     * @param  int  $id  The ID of the task to be updated.
     * @param  TaskData  $request  The updated task data to be stored.
     * @return TaskData           The updated task data.
     */
    public function update(int $id, TaskData $request): TaskData
    {
        return $this->todoListRepository->updateTask($id, $request);
    }

    /**
     * Delete a task from the tasks list.
     *
     * @param  int  $id  The id of the task to be deleted.
     * @return bool   True if the task is successfully deleted, otherwise false.
     */
    public function delete(int $id): bool
    {
        return $this->todoListRepository->deleteTask($id);
    }
}
