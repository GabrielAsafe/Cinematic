<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sala extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = false;
    protected $dates = ['deleted_at'];

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
