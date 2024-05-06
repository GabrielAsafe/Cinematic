<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lugar extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['sala_id', 'fila', 'posicao', 'custom', 'deleted_at'];

}
