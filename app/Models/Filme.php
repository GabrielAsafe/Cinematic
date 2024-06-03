<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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
        return $this->hasMany(Sessao::class, 'filme_id', 'id')->whereDate('data', '>=', now()->toDateString());;
    }

    protected function fullCartazUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->cartaz_url ? asset('storage/cartazes/' . $this->cartaz_url) : asset('/img/avatar_unknown.png');
            },
        );
    }
}
