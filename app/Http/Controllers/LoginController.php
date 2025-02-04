<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Seguridad\CrearUsuario;
use App\Services\Seguridad\ComprobarCredenciales;

class LoginController extends Controller
{
    public function signup(Request $request){
        $crearUsuario = app(CrearUsuario::class);
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $registro = $crearUsuario->handle($name,$email,$password);
        if ($registro != null) {
            return response()->json(['message' => 'Usuario creado correctamente'], 201);
        } else {
            return response()->json(['message' => 'Error al crear el usuario'], 500);
        }
    }

    public function login(Request $request){
        $comprobarCredenciales = app(ComprobarCredenciales::class);
        $email = $request->input('email');
        $password = $request->input('password');
        $user = $comprobarCredenciales->handle($email,$password);
        if ($user != null) {
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'Error al loguear el usuario'], 403);
        }
    }

    public function whoami(Request $request){
        return response()->json($request->user(), 200);
    }
}
