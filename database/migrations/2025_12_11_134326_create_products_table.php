<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Este é o ID auto-incrementado
            $table->string('nome');
            $table->integer('quantidade_unidades');
            $table->decimal('preco', 8, 2); // Exemplo: 999999.99
            $table->foreignId('idCategoria')->constrained('categorias'); // Relacionamento com a tabela 'categorias'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
