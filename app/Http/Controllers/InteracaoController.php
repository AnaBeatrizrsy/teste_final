<?php

namespace App\Http\Controllers;

use App\Models\Publicacao;
use App\Models\Like;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InteracaoController extends Controller
{
    public function like($publicacaoId)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Usuário não logado'], 401);
        }

        // Remove dislike se existir
        Like::where('publicacao_id', $publicacaoId)
            ->where('usuario_id', Auth::id())
            ->where('tipo', 'dislike')
            ->delete();

        // Verifica se já deu like
        $like = Like::where('publicacao_id', $publicacaoId)
            ->where('usuario_id', Auth::id())
            ->where('tipo', 'like')
            ->first();

        if ($like) {
            // Remove like
            $like->delete();
        } else {
            // Adiciona like
            Like::create([
                'publicacao_id' => $publicacaoId,
                'usuario_id' => Auth::id(),
                'tipo' => 'like'
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function dislike($publicacaoId)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Usuário não logado'], 401);
        }

        // Remove like se existir
        Like::where('publicacao_id', $publicacaoId)
            ->where('usuario_id', Auth::id())
            ->where('tipo', 'like')
            ->delete();

        // Verifica se já deu dislike
        $dislike = Like::where('publicacao_id', $publicacaoId)
            ->where('usuario_id', Auth::id())
            ->where('tipo', 'dislike')
            ->first();

        if ($dislike) {
            // Remove dislike
            $dislike->delete();
        } else {
            // Adiciona dislike
            Like::create([
                'publicacao_id' => $publicacaoId,
                'usuario_id' => Auth::id(),
                'tipo' => 'dislike'
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function comentar(Request $request, $publicacaoId)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Usuário não logado'], 401);
        }

        $request->validate([
            'comentario' => 'required|string|max:1000'
        ]);

        $comentario = Comentario::create([
            'publicacao_id' => $publicacaoId,
            'usuario_id' => Auth::id(),
            'texto' => $request->comentario
        ]);

        return response()->json(['success' => true, 'comentario' => $comentario]);
    }

    public function editarComentario(Request $request, $comentarioId)
    {
        $comentario = Comentario::findOrFail($comentarioId);

        if ($comentario->usuario_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Não autorizado'], 403);
        }

        $request->validate([
            'comentario' => 'required|string|max:1000'
        ]);

        $comentario->update([
            'texto' => $request->comentario
        ]);

        return response()->json(['success' => true]);
    }

    public function excluirComentario($comentarioId)
    {
        $comentario = Comentario::findOrFail($comentarioId);

        if ($comentario->usuario_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Não autorizado'], 403);
        }

        $comentario->delete();

        return response()->json(['success' => true]);
    }
}