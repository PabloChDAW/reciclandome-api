<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        // $minusculas = array_merge(
        //     range('a', 'z'),
        //     ['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ']
        // );

        // $mayusculas = array_merge(
        //     range('A', 'Z'),
        //     ['Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', 'Ñ']
        // );

        // $numeros = range('0', '9');

        // $simbolos = str_split('!@#$%^&*()-_=+[]{};:,.<>?¿¡');

        // $password = $fields['password'];
        // $passwordarray = str_split($password);

        // $hasMinus = count(array_intersect($passwordarray, $minusculas)) > 0;
        // $hasMayus = count(array_intersect($passwordarray, $mayusculas)) > 0;
        // $hasNum = count(array_intersect($passwordarray, $numeros)) > 0;
        // $hasSymbols = count(array_intersect($passwordarray, $simbolos)) > 0;
        // $haslength12 = count($passwordarray) >= 12;

        // if(!$hasMinus){
        //     return response()->json([
        //     'errors' => 'La contraseña debe tener Minúsculas'
        //     ], 422);
        // }
        // if(!$hasMayus){
        //     return response()->json([
        //     'errors' => 'La contraseña debe tener Mayúsculas'
        //     ], 422);
        // }
        // if(!$hasSymbols){
        //     return response()->json([
        //     'errors' => 'La contraseña debe tener Símbolos'
        //     ], 422);
        // }
        // if(!$hasNum){
        //     return response()->json([
        //     'errors' => 'La contraseña debe tener Números'
        //     ], 422);
        // }
        // if(!$haslength12){
        //     return response()->json([
        //     'errors' => 'La contraseña debe tener 12 caracteres'
        //     ], 422);
        // }

        $user = User::create($fields);
        $token = $user->createToken($request->name);

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
