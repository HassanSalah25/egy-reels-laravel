<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CommentUser>
 */
class CommentUserFactory extends Factory
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
            'comment_id' => $this->faker->randomDigitNotNull,
            'user_id' => $this->faker->randomDigitNotNull,

        ];
    }
}
