<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\TodoDTO;
use App\DTO\TodoFilterDTO;
use App\Enums\TodoStatusEnum;
use App\Interfaces\Repository\TodoListRepositoryInterface;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;

class TodoListRepository implements TodoListRepositoryInterface
{
    public function getTodoList(TodoFilterDTO $todoFilterDTO): Collection
    {
        return Todo::all();
    }

    public function getTodoById(int $id): Todo
    {
        return Todo::findOrFail($id);
    }

    public function markTodoAsComplete(int $id): bool
    {
        return $this->getTodoById($id)->update(['status' => TodoStatusEnum::DONE]);
    }

    public function createTodo(TodoDTO $data): Todo
    {
        return Todo::create($data);
    }

    public function updateTodo(int $id, TodoDTO $data): Todo
    {
        $todo = $this->getTodoById($id);

        $todo->update((array)$data);

        return $todo;
    }

    public function deleteTodo(int $id): bool
    {
        return !!Todo::destroy($id);
    }
}
