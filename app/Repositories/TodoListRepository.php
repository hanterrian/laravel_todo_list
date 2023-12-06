<?php

namespace App\Repositories;

use App\DTO\TodoDTO;
use App\Interfaces\Repository\TodoListRepositoryInterface;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;

class TodoListRepository implements TodoListRepositoryInterface
{
    public function getAllTodoList(): Collection
    {
        return Todo::all();
    }

    public function getTodoList(): Collection
    {
        // TODO: Implement getTodoList() method.
    }

    public function getCompletedTodoList(): Collection
    {
        // TODO: Implement getCompletedTodoList() method.
    }

    public function getTodoById(int $id): Todo
    {
        // TODO: Implement getTodoById() method.
    }

    public function markTodoAsComplete(int $id): bool
    {
        // TODO: Implement markTodoAsComplete() method.
    }

    public function createTodo(TodoDTO $data): Todo
    {
        // TODO: Implement createTodo() method.
    }

    public function updateTodo(int $id, TodoDTO $data): Todo
    {
        // TODO: Implement updateTodo() method.
    }

    public function deleteTodo(int $id): bool
    {
        // TODO: Implement deleteTodo() method.
    }
}
