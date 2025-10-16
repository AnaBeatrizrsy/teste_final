<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContatoProfessor extends Controller

{
    /**
     * Exibe a lista de professores.
     */
    public function index()
    {
        $professores = ContatoProfessor::all();
        return view('contato_professor.index', compact('professores'));
    }

    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        return view('contato_professor.create');
    }

    /**
     * Salva um novo professor no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'disciplina' => 'required|string|max:255'
        ]);

        ContatoProfessor::create([
            'nome' => $request->nome,
            'disciplina' => $request->disciplina
        ]);

        return redirect()->route('contato_professor.index')->with('success', 'Professor cadastrado com sucesso!');
    }

    /**
     * Exibe os detalhes do professor.
     */
    public function show($id)
    {
        $professor = ContatoProfessor::findOrFail($id);
        return view('contato_professor.show', compact('professor'));
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit($id)
    {
        $professor = ContatoProfessor::findOrFail($id);
        return view('contato_professor.edit', compact('professor'));
    }

    /**
     * Atualiza um professor existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'disciplina' => 'required|string|max:255'
        ]);

        $professor = ContatoProfessor::findOrFail($id);
        $professor->update([
            'nome' => $request->nome,
            'disciplina' => $request->disciplina
        ]);

        return redirect()->route('contato_professor.index')->with('success', 'Professor atualizado com sucesso!');
    }

    /**
     * Remove um professor.
     */
    public function destroy($id)
    {
        $professor = ContatoProfessor::findOrFail($id);
        $professor->delete();

        return redirect()->route('contato_professor.index')->with('success', 'Professor excluído com sucesso!');
    }

}
