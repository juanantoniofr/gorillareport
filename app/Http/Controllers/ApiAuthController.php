<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facade\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ApiAuthController extends Controller
{
    
    //
    public function login(Request $request){
        //valida las credenciales del usuario
        if (!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'message' => 'Invalid access credentials'
            ], 401);
        }

        //Busca al usuario en la base de datos
        $user = User::where('email', $request['email'])->firstOrFail();

        //Genera un nuevo token para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        //devuelve una respuesta JSON con el token generado y el tipo de token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

}
