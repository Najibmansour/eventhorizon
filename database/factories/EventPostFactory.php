<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventPost>
 */
class EventPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'title'=> fake()->sentence(),
        'description' => fake()->text(300),
        'start_date' => fake()->date(),
        'end_date'=> fake()->date(),
        'location_name' => fake()->address(),
        'location_url' => fake()->url(),
        'tags'=> fake()->word(),
        'event_image_url' => fake()->url(),
        'owner_id' => 1, // Foreign key
        'price' => fake()->numberBetween(0, 1000),
        'restriction_age_min' => null,
        'restriction_age_max'=> null,
        'accecciblity_disablity' => fake()->boolean(),
        ];
    }
}
