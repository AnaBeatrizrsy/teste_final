<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InteracaoController extends Controller
{
    public function like(Request $request)
    {
        if (!Auth::check()) return response()->json(['error' => 'unauthorized'], 401);

        $user = Auth::user();
        $likeExist = DB::table('likes')
            ->where('usuario_id', $user->id)
            ->where('publicacao_id', $request->publicacao_id)
            ->where('tipo', 'like')
            ->first();

        if ($likeExist) {
            DB::table('likes')->where('id_like', $likeExist->id_like)->delete();
        } else {
            DB::table('likes')->insert([
                'usuario_id' => $user->id,
                'publicacao_id' => $request->publicacao_id,
                'tipo' => 'like',
                'createdAt' => now()
            ]);
            DB::table('likes')->where('usuario_id', $user->id)->where('publicacao_id', $request->publicacao_id)->where('tipo', 'dislike')->delete();
        }

        return $this->getCounts($request->publicacao_id);
    }

    public function dislike(Request $request)
    {
        if (!Auth::check()) return response()->json(['error' => 'unauthorized'], 401);

        $user = Auth::user();
        $dislikeExist = DB::table('likes')
            ->where('usuario_id', $user->id)
            ->where('publicacao_id', $request->publicacao_id)
            ->where('tipo', 'dislike')
            ->first();

        if ($dislikeExist) {
            DB::table('likes')->where('id_like', $dislikeExist->id_like)->delete();
        } else {
            DB::table('likes')->insert([
                'usuario_id' => $user->id,
                'publicacao_id' => $request->publicacao_id,
                'tipo' => 'dislike',
                'createdAt' => now()
            ]);
            DB::table('likes')->where('usuario_id', $user->id)->where('publicacao_id', $request->publicacao_id)->where('tipo', 'like')->delete();
        }

        return $this->getCounts($request->publicacao_id);
    }

    private function getCounts($publicacao_id)
    {
        return response()->json([
            'likes' => DB::table('likes')->where('publicacao_id', $publicacao_id)->where('tipo', 'like')->count(),
            'dislikes' => DB::table('likes')->where('publicacao_id', $publicacao_id)->where('tipo', 'dislike')->count()
        ]);
    }
}
