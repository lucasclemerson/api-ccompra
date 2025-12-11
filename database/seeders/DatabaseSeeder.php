<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\CategoriaSeeder; // Importe o seeder de Categoria
use Database\Seeders\ProductSeeder; // Importe o seeder de Produto

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            CategoriaSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
