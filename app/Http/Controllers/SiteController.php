<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Publicacao;

class SiteController extends Controller
{
    public function index()
    {
        // pega a primeira empresa (ajuste se tiver várias)
        $empresa = Empresa::first();

        // publicações da empresa com contagem de comentários/likes placeholders
        $publicacoes = Publicacao::where('empresa_id', $empresa->id_empresa)
            ->get()
            ->map(function($p) {
                // ajuste os nomes de campo conforme seu banco
                $p->qtd_likes = 0;       // só visualização (funcionalidade de like será feita depois)
                $p->qtd_dislikes = 0;
                $p->comentarios_count = 0;
                return $p;
            });

        // agregados gerais (somando os placeholders)
        $empresa_likes = 0;
        $empresa_deslikes = 0;

        return view('home', compact('empresa','publicacoes','empresa_likes','empresa_deslikes'));
    }
}