<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\TaskDTO;
use App\DTO\TaskFilterDTO;
use App\Enums\TaskStatusEnum;
use App\Interfaces\Repository\TaskListRepositoryInterface;
use App\Models\Task;
use Carbon\Carbon;
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

    public function getUncompleteChildrenCount(int $id): int
    {
        $item = Task::findOrFail($id);

        return $item->chilren()
            ->where('status', TaskStatusEnum::TODO)
            ->count();
    }

    public function markTaskAsComplete(int $id): bool
    {
        return Task::findOrFail($id)->update([
            'status' => TaskStatusEnum::DONE,
            'completed_at' => Carbon::now(),
        ]);
    }

    public function createTask(TaskDTO $data): TaskDTO
    {
        return Task::create($data->toArray())->getData();
    }

    public function updateTask(int $id, TaskDTO $data): TaskDTO
    {
        $todo = Task::findOrFail($id);

        $todo->update($data->toArray());

        return $todo->getData();
    }

    public function deleteTask(int $id): bool
    {
        return !!Task::destroy($id);
    }
}
