<?php

namespace Database\Factories;

use App\Models\Category; 
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence,
            'id_category' => Category::factory(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'stock' => $this->faker->numberBetween(0, 1000),
            'iva' => $this->faker->randomFloat(2, 0, 1),
        ];
    }
}