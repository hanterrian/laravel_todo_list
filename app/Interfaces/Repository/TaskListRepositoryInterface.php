<?php

declare(strict_types=1);

namespace App\Interfaces\Repository;

use App\DTO\TaskDTO;
use App\DTO\TaskFilterDTO;
use Spatie\LaravelData\DataCollection;

interface TaskListRepositoryInterface
{
    /**
     * @param  TaskFilterDTO  $todoFilterDTO
     * @return DataCollection
     */
    public function getTaskList(TaskFilterDTO $todoFilterDTO): DataCollection;

    public function getTaskById(int $id): TaskDTO;

    public function getUncompleteChildrenCount(int $id): int;

    public function markTaskAsComplete(int $id): bool;

    public function createTask(TaskDTO $data): TaskDTO;

    public function updateTask(int $id, TaskDTO $data): TaskDTO;

    public function deleteTask(int $id): bool;
}
