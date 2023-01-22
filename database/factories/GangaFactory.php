<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ganga>
 */
class GangaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $price = fake()->numberBetween(1, 2000);
        return [
            'title' => fake()->unique()->word(),
            'description' => fake()->paragraph(2),
            'url' => fake()->url(),
            'likes' => 0,
            'unlikes' => 0,
            'price' => $price,
            'price_sale' => $price * 0.8,
            'available' => 1,
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'photo' => 'foto.jpg'
        ];
    }
}
