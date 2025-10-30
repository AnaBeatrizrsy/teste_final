<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';
    protected $primaryKey = 'id_like';

    protected $fillable = [
        'usuario_id',
        'publicacao_id',
        'tipo'
    ];

    public function publicacao()
    {
        return $this->belongsTo(Publicacao::class, 'publicacao_id', 'id_publicacao');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
}