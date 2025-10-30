<?php
// app/Models/Comentario.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $table = 'comentario';

    protected $fillable = [
        'texto',
        'usuario_id',
        'publicacao_id',
    ];

    public $timestamps = false;
}
