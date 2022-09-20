<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reel>
 */
class ReelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->name,
            'caption'	=> $this->faker->text,
            'video_url'=> $this->faker->url,
            'likes_count' => $this->faker->randomDigitNotNull,
            'comments_count' => $this->faker->randomDigitNotNull,
        ];
    }
}
