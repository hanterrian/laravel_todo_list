<?php

namespace Database\Factories;

use App\Enums\TaskStatusEnum;
use App\Models\Scopes\OwnerScope;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $randomUser = User::inRandomOrder()->first();
        $parentTask = Task::withoutGlobalScope(OwnerScope::class)
            ->whereOwnerId($randomUser->id)
            ->inRandomOrder()
            ->first();

        return [
            'owner_id' => $parentTask->owner_id ?? $randomUser->id,
            'parent_id' => $parentTask->id ?? null,
            'status' => TaskStatusEnum::TODO,
            'priority' => rand(1, 5),
            'title' => $this->faker->text(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
