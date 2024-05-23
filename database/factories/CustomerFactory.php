<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\TypeDocument;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'id_type' => TypeDocument::factory(), // Assumes you have a TypeDocumentFactory
            'document' => $this->faker->unique()->numerify('#########'),
            'phone' => $this->faker->unique()->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
