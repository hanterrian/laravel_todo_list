<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\TaskDTO;
use App\DTO\TaskFilterDTO;
use App\Enums\TaskStatusEnum;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Interfaces\Repository\TaskListRepositoryInterface;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelData\DataCollection;

class TaskListRepository implements TaskListRepositoryInterface
{
    /**
     * @param  TaskFilterDTO  $todoFilterDTO
     * @return DataCollection<TaskDTO>
     */
    public function getTaskList(TaskFilterDTO $todoFilterDTO): DataCollection
    {
        return TaskDTO::collection(Task::withExists(['children'])->get());
    }

    public function getTaskById(int $id): TaskDTO
    {
        return Task::withExists(['children'])->findOrFail($id)->getData();
    }

    public function markTaskAsComplete(int $id): bool
    {
        $task = Task::with([
            'children' => function (HasMany $query) {
                $query->where(['status' => TaskStatusEnum::TODO]);
            },
        ])->findOrFail($id);

        if ($task->status === TaskStatusEnum::DONE) {
            throw ValidationException::withMessages([
                'id' => 'Task is already completed',
            ]);
        }

        if ($task->children->count() > 0) {
            throw ValidationException::withMessages([
                'id' => 'You cannot finish a task until you have completed all sub-tasks',
            ]);
        }
        return $task->update([
            'status' => TaskStatusEnum::DONE,
            'completed_at' => Carbon::now(),
        ]);
    }

    public function createTask(CreateTaskRequest $data): TaskDTO
    {
        return Task::create($data->all())->getData();
    }

    public function updateTask(int $id, UpdateTaskRequest $data): TaskDTO
    {
        $todo = Task::findOrFail($id);

        $todo->update($data->all());

        return $todo->getData();
    }

    public function deleteTask(int $id): bool
    {
        return !!Task::findOrFail($id)->delete();
    }
}
