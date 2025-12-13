<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Busca todos os produtos do banco de dados
        $users = User::all();
        

        // Retorna a lista de produtos como uma resposta JSON
        return response()->json($users, 200);
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6', 
            'photo' => 'required|min:6', 
        ]);

        // 2. Criação do novo produto no banco de dados
        $user = User::create($validatedData);

        // 3. Retorna a resposta JSON (Status 201 Created é padrão para criação)
        
        if (!$user) {
            return response()->json([
                'message' => 'Erro ao criar o usuário.'
            ], 500);
        }else{
            return response()->json([
                'message' => 'Usuário criado com sucesso!',
                'user' => $user
            ], 201);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user, 200);
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
            'email' => 'sometimes|required|email|unique:users,email',
            'password' => 'sometimes|required|min:6',
            'photo' => 'sometimes|required|min:6',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->all());
        
        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'user' => $user,
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
        $user = User::findOrFail($id);
        $user->delete();

        // Retorna uma resposta de sucesso (HTTP 204 No Content é padrão para deleção)
        return response()->json([
            'Usuário' => $user->nome,
            'message' => 'Usuário deletado com sucesso!'
        ], 200); 
    }
}
