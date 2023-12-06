<?php

namespace App\Http\Controllers\Api;

use App\DTO\TodoDTO;
use App\DTO\TodoFilterDTO;
use App\Enums\TodoStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Interfaces\Repository\TodoListRepositoryInterface;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TodoController extends Controller
{
    public function __construct(
        private readonly TodoListRepositoryInterface $todoListRepository
    ) {
    }

    public function index(Request $request)
    {
        return TodoResource::collection($this->todoListRepository->getTodoList(new TodoFilterDTO(...$request->all())));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'status' => ['required', Rule::enum(TodoStatusEnum::class)],
            'priority' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:5000'],
        ]);

        return new TodoResource($this->todoListRepository->createTodo(new TodoDTO(...$data)));
    }

    public function show(int $id)
    {
        return new TodoResource($this->todoListRepository->getTodoById($id));
    }

    public function complete(int $id)
    {
        return response()->json([
            'status' => $this->todoListRepository->markTodoAsComplete($id),
        ]);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'status' => ['required', Rule::enum(TodoStatusEnum::class)],
            'priority' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:5000'],
        ]);

        return new TodoResource($this->todoListRepository->updateTodo($id, new TodoDTO(...$data)));
    }

    public function destroy(int $id)
    {
        return response()->json([
            'status' => $this->todoListRepository->deleteTodo($id),
        ]);
    }
}
