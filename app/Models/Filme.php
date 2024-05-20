<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['titulo', 'genero_code', 'ano', 'cartaz_url', 'sumario','trailer_url'];
}