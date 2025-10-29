<?php

namespace App\Http\Controllers;

use App\Models\Publicacao;
use App\Models\Empresa;

class SiteController extends Controller
{
   public function index()
{
    // Buscar todas as publicações com suas empresas relacionadas
    $publicacoes = \App\Models\Publicacao::with('empresa')->get();

    // Buscar a empresa (ajuste o ID conforme sua tabela)
    $empresa = \App\Models\Empresa::find(1);

    // Se quiser calcular likes e deslikes gerais:
    $empresa_likes = 0;
    $empresa_deslikes = 0;

    if ($empresa) {
        foreach ($publicacoes as $pub) {
            $empresa_likes += $pub->likes ?? 0;
            $empresa_deslikes += $pub->deslikes ?? 0;
        }
    }

    // Enviar todas as variáveis para a view
    return view('home', compact('publicacoes', 'empresa', 'empresa_likes', 'empresa_deslikes'));
}

}