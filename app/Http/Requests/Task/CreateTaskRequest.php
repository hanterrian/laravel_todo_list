<?php

namespace App\Http\Requests\Task;

use App\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'parent_id' => ['integer', Rule::exists('tasks', 'id')],
            'status' => ['required', Rule::enum(TaskStatusEnum::class)],
            'priority' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:5000'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
