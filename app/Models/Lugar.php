<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lugar extends Model
{
    use HasFactory;
    public $table = 'lugares';
    public $timestamps = false;

    protected $fillable = ['sala_id', 'fila', 'posicao', 'custom', 'deleted_at'];

    public function salaRef(): BelongsTo
    {
        return $this->belongsTo(Sala::class, 'sala_id', 'id');
    }

}
