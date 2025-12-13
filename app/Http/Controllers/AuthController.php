<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'status' => 201,
            'token' => $token,
            'user' => $user
        ]);
    }   

    public function register(Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:3|confirmed',
            'foto'    => 'required|string',
        ]);

        
        

        $user = User::create([
            'nome'     => $request->nome,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'foto'    => $request->foto ?? 'man.png',
        ]);
        
      
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuário criado com sucesso',
            'user'    => $user,
            'token'   => $token,
        ], 201);
        
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['status' => 201, 'message' => 'Logout feito']);
    }
}
