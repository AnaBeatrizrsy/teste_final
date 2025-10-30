<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresa';
    protected $primaryKey = 'id_empresa';
    public $timestamps = false; // se você não usa created_at/updated_at padrões
    protected $fillable = ['nome','logo','createdAt','updatedAt'];

    public function publicacoes()
    {
        return $this->hasMany(Publicacao::class, 'empresa_id', 'id_empresa');
    }
}