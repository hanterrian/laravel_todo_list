<?php

declare(strict_types=1);

namespace App\Interfaces\Repository;

use App\DTO\TaskDTO;
use App\DTO\TaskFilterDTO;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

interface TaskListRepositoryInterface
{
    /**
     * @return Collection<Task>
     */
    public function getTaskList(TaskFilterDTO $todoFilterDTO): Collection;

    public function getTaskById(int $id): Task;

    public function getUncompleteChildrenCount(int $id): int;

    public function markTaskAsComplete(int $id): bool;

    public function createTask(TaskDTO $data): Task;

    public function updateTask(int $id, TaskDTO $data): Task;

    public function deleteTask(int $id): bool;
}
