<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    use HasFactory;


    public $timestamps = false;

    protected $fillable = ['id','filme_id', 'sala_id', 'data', 'hora_inicio', 'custom'];
}

