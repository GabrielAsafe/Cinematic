<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sessao extends Model
{
    use HasFactory;

    protected $table = 'sessoes';

    protected $fillable = ['id','filme_id', 'sala_id', 'data', 'horario_inicio', 'custom'];

    public function filmeRef(): BelongsTo
    {
        return $this->belongsTo(Filme::class, 'filme_id', 'id');
    }

    public function salaRef(): BelongsTo
    {
        return $this->belongsTo(Sala::class, 'sala_id', 'id');
    }

}
