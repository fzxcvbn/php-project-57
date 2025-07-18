<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'           => fake()->unique()->name,
            'description'    => fake()->text,
            'status_id'      => TaskStatus::factory(),
            'created_by_id'  => User::factory(),
            'assigned_to_id' => User::factory(),
        ];
    }
}
