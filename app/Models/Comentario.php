<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentarios';
    protected $primaryKey = 'id_comentario';
    public $timestamps = true; // ou false

    protected $fillable = [
        'usuario_id',
        'publicacao_id',
        'texto'
    ];

    // Relacionamento com usuário
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    // Relacionamento com publicação
    public function publicacao()
    {
        return $this->belongsTo(Publicacao::class, 'publicacao_id', 'id_publicacao');
    }
}
