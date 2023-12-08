<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TaskDTO;
use App\DTO\TaskFilterDTO;
use App\Enums\TaskStatusEnum;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Interfaces\Repository\TaskListRepositoryInterface;
use App\Interfaces\Service\TaskListServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelData\DataCollection;

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
     * @param  Request  $request  The HTTP request object.
     * @return Collection<TaskDTO> A collection of tasks items that match the provided filters.
     */
    public function getAll(Request $request): DataCollection
    {
        return $this->todoListRepository->getTaskList(TaskFilterDTO::from($request->all()));
    }

    /**
     * Retrieves a single task by its ID.
     *
     * @param  int  $id  The ID of the task.
     * @return TaskDTO      The task object matching the provided ID.
     */
    public function getOne(int $id): TaskDTO
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
        $uncompleteChildrenCount = $this->todoListRepository->getUncompleteChildrenCount($id);

        if ($uncompleteChildrenCount !== 0) {
            throw new ValidationException('Task has uncomplete subtasks');
        }

        return $this->todoListRepository->markTaskAsComplete($id);
    }

    public function store(CreateTaskRequest $request): TaskDTO
    {
        return $this->todoListRepository->createTask($request);
    }

    public function update(int $id, UpdateTaskRequest $request): TaskDTO
    {
        return $this->todoListRepository->updateTask($id, $request);
    }

    public function delete(int $id): bool
    {
        return $this->todoListRepository->deleteTask($id);
    }
}
