<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Data\TaskData;
use App\Data\TaskFilterData;
use App\Enums\TaskStatusEnum;
use App\Filters\QueryFilter;
use App\Interfaces\Repository\TaskListRepositoryInterface;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\ValidationException;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Exceptions\InvalidDataClass;

class TaskListRepository implements TaskListRepositoryInterface
{
    /**
     * Get all tasks
     *
     * @param  QueryFilter  $filter
     * @param  TaskFilterData  $todoFilterDTO
     * @return DataCollection<TaskData>
     */
    public function getTaskList(QueryFilter $filter, TaskFilterData $todoFilterDTO): DataCollection
    {
        $builder = Task::withExists(['children'])
            ->filter($filter, $todoFilterDTO);

        return TaskData::collection($builder->get());
    }

    /**
     * Get task by id
     *
     * @param  int  $id
     * @return TaskData
     */
    public function getTaskById(int $id): TaskData
    {
        return Task::withExists(['children'])->findOrFail($id)->getData();
    }

    /**
     * Complete the task
     *
     * @param  int  $id
     * @return bool
     */
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

    /**
     * Create new task
     *
     * @param  TaskData  $data
     * @return TaskData
     * @throws InvalidDataClass
     */
    public function createTask(TaskData $data): TaskData
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

    /**
     * Update the task
     *
     * @param  int  $id
     * @param  TaskData  $data
     * @return TaskData
     * @throws InvalidDataClass
     */
    public function updateTask(int $id, TaskData $data): TaskData
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

    /**
     * Delete the task
     *
     * @param  int  $id
     * @return bool
     */
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
