<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'nama' => fake()->sentence,
            'deskripsi' => fake()->paragraph,
            // 'gambar' => 'assets/img/avatars/no-image.png',
            'status' => fake()->randomElement([0, 1]),
        ];
    }
}
