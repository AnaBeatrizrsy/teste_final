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

        // Busca usuário na tabela 'usuario'
        $usuario = Usuario::where('email', $request->email)
            ->where('senha', $request->senha)
            ->first();

        // Se não encontrou, mostra erro
        if (!$usuario) {
            return back()->withErrors(['msg' => 'Usuário ou senha incorreto'])->withInput();
        }

        // Cria sessão do usuário logado
        session([
            'usuario_logado' => $usuario->id,
            'usuario_logado_nome' => $usuario->nome,
        ]);

        return redirect('/'); // redireciona pra home
    }

    public function logout()
    {
        session()->forget(['usuario_logado', 'usuario_logado_nome']);
        return redirect('/');
    }
}
