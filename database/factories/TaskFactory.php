<?php

namespace Database\Factories;

use App\Enums\TaskStatusEnum;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'owner_id' => User::inRandomOrder()->first()?->id,
            'parent_id' => Task::inRandomOrder()->first()?->id,
            'status' => TaskStatusEnum::TODO,
            'priority' => rand(1, 5),
            'title' => $this->faker->text(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
