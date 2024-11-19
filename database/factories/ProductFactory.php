<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word(), // Random product name
            'description' => $this->faker->sentence(), // Random description
            'image' => $this->faker->imageUrl(), // Random image URL
            'price' => $this->faker->randomFloat(2, 10, 1000), // Random price
            'warranty' => $this->faker->numberBetween(1, 24), // Random warranty in months
        ];
    }
}
