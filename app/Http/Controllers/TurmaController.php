<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma;
use App\Models\Curso;

class TurmaController extends Controller
{
    /**
     * Exibe a lista de turmas.
     */
    public function index()
    {
        $turmas = Turma::with('curso')->get();
        return view('turma.index', compact('turmas'));
    }

    /**
     * Exibe o formulário de cadastro.
     */
    public function create()
    {
        $cursos = Curso::all();
        return view('turma.create', compact('cursos'));
    }

    /**
     * Salva uma nova turma no banco de dados.
     */
    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'curso_id' => 'required|integer|exists:curso,id'
        ]);

        Turma::create([
            'descricao' => $request->descricao,
            'curso_id' => $request->curso_id
        ]);

        return redirect()->route('turma.index')->with('success', 'Turma cadastrada com sucesso!');
    }

    /**
     * Exibe os detalhes da turma.
     */
    public function show($id)
    {
        $turma = Turma::with(['curso', 'alunos'])->findOrFail($id);
        return view('turma.show', compact('turma'));
    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit($id)
    {
        $turma = Turma::findOrFail($id);
        $cursos = Curso::all();
        return view('turma.edit', compact('turma', 'cursos'));
    }

    /**
     * Atualiza uma turma existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'descricao' => 'required|string|max:255',
            'curso_id' => 'required|integer|exists:curso,id'
        ]);

        $turma = Turma::findOrFail($id);
        $turma->update([
            'descricao' => $request->descricao,
            'curso_id' => $request->curso_id
        ]);

        return redirect()->route('turma.index')->with('success', 'Turma atualizada com sucesso!');
    }

    /**
     * Remove uma turma.
     */
    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);
        $turma->delete();

        return redirect()->route('turma.index')->with('success', 'Turma excluída com sucesso!');
    }
}