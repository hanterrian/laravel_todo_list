<?php

namespace App\Http\Controllers;

use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return TodoResource::collection(Todo::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'status' => ['required'],
            'priority' => ['required', 'integer'],
            'title' => ['required'],
            'description' => ['required'],
            'createdAt' => ['required', 'date'],
            'completedAt' => ['nullable', 'date'],
        ]);

        return new TodoResource(Todo::create($data));
    }

    public function show(Todo $todo)
    {
        return new TodoResource($todo);
    }

    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'status' => ['required'],
            'priority' => ['required', 'integer'],
            'title' => ['required'],
            'description' => ['required'],
            'createdAt' => ['required', 'date'],
            'completedAt' => ['nullable', 'date'],
        ]);

        $todo->update($data);

        return new TodoResource($todo);
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response()->json();
    }
}
