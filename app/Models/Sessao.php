<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sessao extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'sessoes';

    protected $fillable = ['id','filme_id', 'sala_id', 'data', 'hora_inicio', 'custom'];

    public function filmeRef(): BelongsTo
    {
        return $this->belongsTo(Filme::class, 'filme_id', 'id');
    }
}
