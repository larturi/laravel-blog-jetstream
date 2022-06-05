<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'url' => $this->faker->randomElement([
                'posts/post-default-1.jpeg', 
                'posts/post-default-2.jpeg',
                'posts/post-default-3.jpeg',
                'posts/post-default-4.jpeg',
                'posts/post-default-5.jpeg',
            ]),
        ];
    }
}
