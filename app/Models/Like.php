<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';
    protected $primaryKey = 'id_like';
    public $timestamps = false;

    protected $fillable = ['usuario_id', 'publicacao_id', 'tipo', 'createdAt'];
}
