<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function loginModal(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Usuário ou senha incorreto']);
        }

        if ($user->senha !== $request->senha) {
            return response()->json(['success' => false, 'message' => 'Usuário ou senha incorreto']);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return response()->json(['success' => true]);
    }
}
