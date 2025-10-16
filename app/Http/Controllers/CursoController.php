<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;   

class CursoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $curso = Curso::all(); // Mudei para plural (convenção)
        return view('curso.index', compact('curso'));
    }

    public function contato()
    {
        return view('curso.contato');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('curso.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        // Validação apenas para o campo nome
        $request->validate([
            'nome' => 'required|string|max:255'
        ]);
        
        // Cria apenas com o nome
        Curso::create([
            'nome' => $request->nome
        ]);

        return redirect()->route('curso.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $curso = Curso::find($id); // Corrigi o nome da variável
        return view('curso.show', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $curso = Curso::find($id);
        return view('curso.edit', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $curso = Curso::find($id);
        
        // Atualiza apenas o nome
        $curso->update([
            'nome' => $request->nome
        ]);
        
        return redirect()->route('curso.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $curso = Curso::find($id);
        $curso->delete();
        return redirect()->route('curso.index');
    }
}