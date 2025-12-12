<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Busca todos os produtos do banco de dados
        $categories = Categoria::all();
        

        // Retorna a lista de produtos como uma resposta JSON
        return response()->json($categories, 200);
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
        ]);

        // 2. Criação do novo produto no banco de dados
        $categoria = Categoria::create($validatedData);

        // 3. Retorna a resposta JSON (Status 201 Created é padrão para criação)
        return response()->json([
            'message' => 'Produto criado com sucesso!',
            'categoria' => $categoria
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
        $categoria = Categoria::findOrFail($id);
        return response()->json($categoria, 200);
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
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->update($request->all());
        
        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'categoria' => $categoria,
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
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        // Retorna uma resposta de sucesso (HTTP 204 No Content é padrão para deleção)
        return response()->json([
            'Categoria' => $categoria->nome,
            'message' => 'Categoria deletada com sucesso!'
        ], 200); 
    }
}
