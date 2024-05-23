<?php

namespace Database\Factories;

use App\Models\TypeDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

class TypeDocumentFactory extends Factory
{
    protected $model = TypeDocument::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_document' => $this->faker->randomElement(['CEDULA DE CIUDADANIA', 'TARJETA DE IDENTIDAD']),
        ];
    }
}
