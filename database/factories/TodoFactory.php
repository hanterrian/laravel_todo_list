<?php

namespace Database\Factories;

use App\Enums\TodoStatusEnum;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TodoFactory extends Factory
{
    protected $model = Todo::class;

    public function definition(): array
    {
        return [
            'owner_id' => User::inRandomOrder()->first()?->id,
            'parent_id' => Todo::inRandomOrder()->first()?->id,
            'status' => TodoStatusEnum::TODO,
            'priority' => rand(1, 5),
            'title' => $this->faker->text(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
