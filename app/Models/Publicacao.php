<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publicacao extends Model
{
    protected $table = 'publicacao';
    protected $primaryKey = 'id_publicacao';
    public $timestamps = false;
}
