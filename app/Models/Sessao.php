<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sessao extends Model
{
    use HasFactory;

    protected $table = 'sessoes';

    protected $fillable = ['filme_id', 'sala_id', 'data', 'horario_inicio'];

    public function filmeRef(): BelongsTo
    {
        return $this->belongsTo(Filme::class, 'filme_id', 'id');
    }

    public function salaRef(): BelongsTo
    {
        return $this->belongsTo(Sala::class, 'sala_id', 'id');
    }

    public function bilhetes(): HasMany
    {
        return $this->hasMany(Bilhete::class, 'sessao_id', 'id');
    }

}
