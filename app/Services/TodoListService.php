<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\TodoDTO;
use App\DTO\TodoFilterDTO;
use App\Enums\TodoStatusEnum;
use App\Http\Resources\TodoResource;
use App\Interfaces\Repository\TodoListRepositoryInterface;
use App\Interfaces\Service\TodoListServiceInterface;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TodoListService implements TodoListServiceInterface
{
    public function __construct(
        private readonly TodoListRepositoryInterface $todoListRepository
    ) {
    }

    /**
     * @param  Request  $request
     * @return Collection<Todo>
     */
    public function getAll(Request $request): Collection
    {
        return $this->todoListRepository->getTodoList(new TodoFilterDTO(...$request->all()));
    }

    public function getOne(int $id): Todo
    {
        return $this->todoListRepository->getTodoById($id);
    }

    public function markAsDone(int $id): bool
    {
        $item = $this->todoListRepository->getTodoById($id);

        $uncompleteChildrenCount = $item->chilren()
            ->where('status', TodoStatusEnum::TODO)
            ->count();

        if ($uncompleteChildrenCount === 0) {
            return $item->update(['status' => TodoStatusEnum::DONE]);
        }

        return false;
    }

    public function store(Request $request): Todo
    {
        $data = $request->validate([
            'status' => ['required', Rule::enum(TodoStatusEnum::class)],
            'priority' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:5000'],
        ]);

        return $this->todoListRepository->createTodo(new TodoDTO(...$data));
    }

    public function update(int $id, Request $request): Todo
    {
        $data = $request->validate([
            'status' => ['required', Rule::enum(TodoStatusEnum::class)],
            'priority' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:5000'],
        ]);

        return $this->todoListRepository->updateTodo($id, new TodoDTO(...$data));
    }

    public function delete(int $id): bool
    {
        return $this->todoListRepository->deleteTodo($id);
    }
}
