<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Publicacao;

class SiteController extends Controller
{
    public function index()
    {
       
        $empresa = Empresa::first();

        // publicações da empresa
        $publicacoes = Publicacao::where('empresa_id', $empresa->id_empresa)
            ->get()
            ->map(function($p) {
               
                $p->qtd_likes = 0;      
                $p->qtd_dislikes = 0;
                $p->comentarios_count = 0;
                return $p;
            });

        
        $empresa_likes = 0;
        $empresa_deslikes = 0;

        return view('home', compact('empresa','publicacoes','empresa_likes','empresa_deslikes'));
    }
}