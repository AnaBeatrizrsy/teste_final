<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    //
    protected $table = "professor";
    protected $fillable = ['nome','disciplina','foto'];
    public $timestamps = false;
}
