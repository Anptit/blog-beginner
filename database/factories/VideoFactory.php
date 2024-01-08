<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Video>
 */
class VideoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all()->except([1])->toArray();

        $posts = Post::all()->toArray();

        return [
            'name' => fake()->sentence(),
            'path' => fake()->imageUrl(),
            'user_id' => User::factory(),
            'post_id' => Post::factory()
        ];
    }
}
