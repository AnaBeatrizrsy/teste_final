<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        
        $usuario = Usuario::where('email', $request->email)
            ->where('senha', $request->senha)
            ->first();

        
        if (!$usuario) {
            return back()->withErrors(['msg' => 'Usuário ou senha incorreto'])->withInput();
        }

        //sessão do usuário logado
        session([
            'usuario_logado' => $usuario->id,
            'usuario_logado_nome' => $usuario->nome,
        ]);

        return redirect('/'); 
    }

    public function logout()
    {
        session()->forget(['usuario_logado', 'usuario_logado_nome']);
        return redirect('/');
    }
}
