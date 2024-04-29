<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bilhete extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['id','recibo_id', 'cliente_id', 'sessao_id', 'lugar_id', 'preco_sem_iva','estado',
        'bilhete_pdf_url', 'bilhete_qrcode_url'];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function recibo(): BelongsTo
    {
        return $this->belongsTo(Recibo::class);
    }

    public function sessoes(): BelongsTo
    {
        return $this->belongsTo(Sessoe::class);
    }

    public function lugare(): BelongsTo
    {
        return $this->belongsTo(Lugare::class);
    }
}
