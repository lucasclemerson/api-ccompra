<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->words(3, true),
            'quantidade_unidades' => $this->faker->numberBetween(1, 100),
            'preco' => $this->faker->randomFloat(2, 10, 1000), // Preço entre 10.00 e 1000.00
            'idCategoria' => $this->faker->numberBetween(1, 5), // ID de categoria fictício
        ];
    }
}
