<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\TaskDTO;
use App\DTO\TaskFilterDTO;
use App\Enums\TaskStatusEnum;
use App\Filters\QueryFilter;
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
    public function getTaskList(QueryFilter $filter, TaskFilterDTO $todoFilterDTO): DataCollection
    {
        $builder = Task::withExists(['children'])
            ->filter($filter, $todoFilterDTO);

        return TaskDTO::collection($builder->get());
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

    public function createTask(TaskDTO $data): TaskDTO
    {
        return Task::create(
            $data->only(
                "parent_id",
                "status",
                "priority",
                "title",
                "description",
            )->toArray()
        )->getData();
    }

    public function updateTask(int $id, TaskDTO $data): TaskDTO
    {
        $todo = Task::findOrFail($id);

        $todo->update(
            $data->only(
                "parent_id",
                "status",
                "priority",
                "title",
                "description",
            )->toArray()
        );

        return $todo->getData();
    }

    public function deleteTask(int $id): bool
    {
        $task = Task::findOrFail($id);

        if ($task->status === TaskStatusEnum::DONE) {
            throw ValidationException::withMessages([
                'id' => 'You cannot delete a task that has already been completed.',
            ]);
        }

        return !!$task->delete();
    }
}
