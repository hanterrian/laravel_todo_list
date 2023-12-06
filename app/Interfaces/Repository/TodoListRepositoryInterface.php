<?php

declare(strict_types=1);

namespace App\Interfaces\Repository;

use App\DTO\TodoDTO;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;

interface TodoListRepositoryInterface
{
    /**
     * @return Collection<Todo>
     */
    public function getAllTodoList(): Collection;

    /**
     * @return Collection<Todo>
     */
    public function getTodoList(): Collection;

    /**
     * @return Collection<Todo>
     */
    public function getCompletedTodoList(): Collection;

    public function getTodoById(int $id): Todo;

    public function markTodoAsComplete(int $id): bool;

    public function createTodo(TodoDTO $data): Todo;

    public function updateTodo(int $id, TodoDTO $data): bool;

    public function deleteTodo(int $id): bool;
}
