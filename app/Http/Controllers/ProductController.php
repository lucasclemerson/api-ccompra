<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Busca todos os produtos do banco de dados
        $products = Product::all();
        
        // Retorna a lista de produtos como uma resposta JSON
        return response()->json($products, 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade_unidades' => 'required|integer|min:0',
            'preco' => 'required|numeric|min:0',
            'idCategoria' => 'required|exists:categorias,id', // Garante que a categoria exista
        ]);

        // 2. Criação do novo produto no banco de dados
        $product = Product::create($validatedData);

        // 3. Retorna a resposta JSON (Status 201 Created é padrão para criação)
        return response()->json([
            'message' => 'Produto criado com sucesso!',
            'product' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'preco' => 'sometimes|required|numeric',
            'idCategoria' => 'sometimes|required|integer',          
            // ... outras validações ...
        ]);

    // $request->all() captura os dados enviados via form-data ou JSON
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'product' => $product,
            'request' => $request->all()
        ], 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // Retorna uma resposta de sucesso (HTTP 204 No Content é padrão para deleção)
        return response()->json([
            'Produto' => $product->nome,
            'message' => 'Produto deletado com sucesso!'
        ], 200); 
    }
}
