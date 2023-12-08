<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\TaskDTO;
use App\DTO\TaskFilterDTO;
use App\Enums\TaskStatusEnum;
use App\Interfaces\Repository\TaskListRepositoryInterface;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class TaskListRepository implements TaskListRepositoryInterface
{
    /**
     * @param  TaskFilterDTO  $todoFilterDTO
     * @return Collection<Task>
     */
    public function getTaskList(TaskFilterDTO $todoFilterDTO): Collection
    {
        return Task::all();
    }

    public function getTaskById(int $id): Task
    {
        return Task::findOrFail($id);
    }

    public function getUncompleteChildrenCount(int $id): int
    {
        $item = $this->getTaskById($id);

        return $item->chilren()
            ->where('status', TaskStatusEnum::TODO)
            ->count();
    }

    public function markTaskAsComplete(int $id): bool
    {
        return $this->getTaskById($id)->update([
            'status' => TaskStatusEnum::DONE,
            'completed_at' => Carbon::now(),
        ]);
    }

    public function createTask(TaskDTO $data): Task
    {
        return Task::create($data);
    }

    public function updateTask(int $id, TaskDTO $data): Task
    {
        $todo = $this->getTaskById($id);

        $todo->update((array)$data);

        return $todo;
    }

    public function deleteTask(int $id): bool
    {
        return !!Task::destroy($id);
    }
}
