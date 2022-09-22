<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Following>
 */
class FollowingFactory extends Factory
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
            'user_id' => Str::random(10) ,
            'fuser_id' => Str::random(10) ,
//            'Date' => $this->faker->dateTimeThisMonth() ,
        ];
    }
}
