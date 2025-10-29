<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa'; // Nome exato da tabela no banco
    protected $primaryKey = 'id_empresa'; // Nome exato da chave primária

    public function publicacoes()
    {
        return $this->hasMany(Publicacao::class, 'empresa_id', 'id_empresa');
    }
}