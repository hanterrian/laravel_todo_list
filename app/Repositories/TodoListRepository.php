<?php

declare(strict_types=1);

namespace App\Repositories;

use App\DTO\TodoDTO;
use App\Enums\TodoStatusEnum;
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
        return Todo::whereStatus(TodoStatusEnum::TODO)->get();
    }

    public function getCompletedTodoList(): Collection
    {
        return Todo::whereStatus(TodoStatusEnum::DONE)->get();
    }

    public function getTodoById(int $id): Todo
    {
        return Todo::findOrFail($id);
    }

    public function markTodoAsComplete(int $id): bool
    {
        return Todo::findOrFail($id)->update(['status' => TodoStatusEnum::DONE]);
    }

    public function createTodo(TodoDTO $data): Todo
    {
        return Todo::create($data);
    }

    public function updateTodo(int $id, TodoDTO $data): bool
    {
        return Todo::findOrFail($id)->update((array)$data);
    }

    public function deleteTodo(int $id): bool
    {
        return !!Todo::destroy($id);
    }
}
