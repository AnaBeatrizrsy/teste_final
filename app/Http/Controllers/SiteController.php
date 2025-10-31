<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
{
    $empresa = DB::table('empresa')->first();
    $empresa_likes = DB::table('likes')->where('tipo', 'like')->count();
    $empresa_dislikes = DB::table('likes')->where('tipo', 'dislike')->count();
    $publicacoes = DB::table('publicacao')->get();

    if (Auth::check()) {
        $usuario = Auth::user();

        $usuarioLikes = DB::table('likes')
            ->where('usuario_id', $usuario->id)
            ->where('tipo', 'like')
            ->count();

        $usuarioDislikes = DB::table('likes')
            ->where('usuario_id', $usuario->id)
            ->where('tipo', 'dislike')
            ->count();

        foreach ($publicacoes as $pub) {
            $pub->likes = DB::table('likes')
                ->where('publicacao_id', $pub->id_publicacao)
                ->where('tipo', 'like')
                ->count();

            $pub->dislikes = DB::table('likes')
                ->where('publicacao_id', $pub->id_publicacao)
                ->where('tipo', 'dislike')
                ->count();

            $pub->liked = DB::table('likes')
                ->where('usuario_id', $usuario->id)
                ->where('publicacao_id', $pub->id_publicacao)
                ->where('tipo', 'like')
                ->exists();

            $pub->disliked = DB::table('likes')
                ->where('usuario_id', $usuario->id)
                ->where('publicacao_id', $pub->id_publicacao)
                ->where('tipo', 'dislike')
                ->exists();
        }

        return view('home', compact('empresa', 'publicacoes', 'usuarioLikes', 'usuarioDislikes'));
    }

    
    foreach ($publicacoes as $pub) {
        $pub->likes = DB::table('likes')
            ->where('publicacao_id', $pub->id_publicacao)
            ->where('tipo', 'like')
            ->count();

        $pub->dislikes = DB::table('likes')
            ->where('publicacao_id', $pub->id_publicacao)
            ->where('tipo', 'dislike')
            ->count();

       
        $pub->liked = false;
        $pub->disliked = false;
    }

    return view('home', compact('empresa', 'empresa_likes', 'empresa_dislikes', 'publicacoes'));
}
}