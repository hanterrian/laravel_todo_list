<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TaskDTO;
use App\DTO\TaskFilterDTO;
use App\Enums\TaskStatusEnum;
use App\Http\Resources\TaskResource;
use App\Interfaces\Repository\TaskListRepositoryInterface;
use App\Interfaces\Service\TaskListServiceInterface;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
     * @return Collection<Task> A collection of tasks items that match the provided filters.
     */
    public function getAll(Request $request): Collection
    {
        return $this->todoListRepository->getTaskList(new TaskFilterDTO(...$request->all()));
    }

    /**
     * Retrieves a single task by its ID.
     *
     * @param  int  $id  The ID of the task.
     * @return Task      The task object matching the provided ID.
     */
    public function getOne(int $id): Task
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

        if ($uncompleteChildrenCount === 0) {
            return $this->todoListRepository->markTaskAsComplete($id);
        } else {
            throw new ValidationException('Task has uncomplete subtasks');
        }

        return false;
    }

    public function store(Request $request): Task
    {
        $data = $request->validate([
            'status' => ['required', Rule::enum(TaskStatusEnum::class)],
            'priority' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:5000'],
        ]);

        return $this->todoListRepository->createTask(new TaskDTO(...$data));
    }

    public function update(int $id, Request $request): Task
    {
        $data = $request->validate([
            'status' => ['required', Rule::enum(TaskStatusEnum::class)],
            'priority' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:5000'],
        ]);

        return $this->todoListRepository->updateTask($id, new TaskDTO(...$data));
    }

    public function delete(int $id): bool
    {
        return $this->todoListRepository->deleteTask($id);
    }
}
