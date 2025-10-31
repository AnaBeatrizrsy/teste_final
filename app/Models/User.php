<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'usuario';
    protected $primaryKey = 'id';

    protected $fillable = ['nome', 'email', 'senha', 'foto'];

    protected $hidden = ['senha'];

    public $timestamps = false;
}
