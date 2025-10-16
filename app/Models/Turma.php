<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    public $timestamps = false;
    
    // ADICIONE ESTA LINHA para especificar o nome da tabela
    protected $table = 'turma';
    
    protected $fillable = [
        'descricao',
        'curso_id'
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }
}  