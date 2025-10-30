<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario'; // nome exato da tabela
    protected $fillable = ['nome', 'email', 'senha'];
    public $timestamps = false; // se tua tabela não tem created_at e updated_at
}
