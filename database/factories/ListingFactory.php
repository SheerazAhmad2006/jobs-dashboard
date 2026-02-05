<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    protected $model = Listing::class;

    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'company' => fake()->company(),
            'location' => fake()->city(),
            'salary' => fake()->randomElement([
                '$40,000',
                '$60,000',
                '$80,000',
                '$100,000'
            ]),
            'description' => fake()->paragraph(4),
            'user_id' => User::factory(),
        ];
    }
}
