<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;   

class ProfessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professor = Professor::all(); 
        return view('professor.index', compact('professor'));
    }

    public function contato()
    {
        return view('professor.contato');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('professor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        $nome_arquivo = pathinfo ($request->foto->getClientOriginalName(), PATHINFO_FILENAME);   
        $extensao_arquivo = $request->foto->getClientOriginalExtension();
        $foto = $nome_arquivo . '-' . time() . '.' . $extensao_arquivo;

        $request->foto->move(public_path('imagens'), $foto);

        Professor::create([
            'nome' => $request->nome,
            'disciplina' => $request->disciplina,
            'foto'=> 'imagens/' . $foto
        ]);

        return redirect()->route('professor.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $professor= Professor::find($id);
        return view('professor.show', compact('professor'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $professor = Professor::find($id);
        return view('professor.edit', compact('professor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Primeiro encontra o professor
    $professor = Professor::find($id);
    
    // Prepara os dados básicos
    $dados = [
        'nome' => $request->nome,
        'disciplina' => $request->disciplina,
    ];
    
    // Só processa a foto se foi enviada no formulário
    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
        $nome_arquivo = pathinfo($request->foto->getClientOriginalName(), PATHINFO_FILENAME);   
        $extensao_arquivo = $request->foto->getClientOriginalExtension();
        $foto = $nome_arquivo . '-' . time() . '.' . $extensao_arquivo;

        $request->foto->move(public_path('imagens'), $foto);
        $dados['foto'] = 'imagens/' . $foto;
    }
    // Se não enviou foto, mantém a foto atual do professor
    
    $professor->update($dados);
    return redirect()->route('professor.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $professor = Professor::find($id);
        $professor->delete();
        return redirect()->route('professor.index');
        //
    }
}
