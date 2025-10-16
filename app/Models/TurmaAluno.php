<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurmaAluno extends Model
{
    //
    protected $table = "turmaaluno";
    protected $fillable = ['id'];
    public $timestamps = false;
}
