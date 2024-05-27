<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sala extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function sessoes(): HasMany
    {
        return $this->hasMany(Sessao::class, 'sala_id', 'id');
    }

    public function lugares(): HasMany
    {
        return $this->hasMany(Lugar::class, 'sala_id', 'id');
    }

}
