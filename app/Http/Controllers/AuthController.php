<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

//use Carbon\Carbon;
class AuthController extends Controller
{
    /**
     * Registro de usuario con creación de Bearer Token y validaciones.
     */
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($fields);
        $token = $user->createToken($request->name);
        //$token = $user->createToken($request->name,[60],Carbon::now()->addMinutes(1));
        
        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    /**
     * Login de usuario con autenticación.
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return [
                'errors' => [
                    'email' => ['Las credenciales introducidas son incorrectas.']
                ]
            ];
        }

        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return [
            'message' => 'Has cerrado la sesión.'
        ];
    }
}
