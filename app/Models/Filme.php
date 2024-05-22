<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Filme extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'genero_code', 'ano', 'cartaz_url', 'sumario','trailer_url'];

    public function generoRef(): BelongsTo
    {
        return $this->belongsTo(Genero::class, 'genero_code', 'code');
    }

    public function sessoes(): HasMany
    {
        return $this->hasMany(Sessao::class, 'filme_id', 'id');
    }
}
