<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bilhete extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['recibo_id', 'cliente_id', 'sessao_id', 'lugar_id', 'preco_sem_iva','estado',
        'bilhete_pdf_url', 'bilhete_qrcode_url'];

    public function clienteRef(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function reciboRef(): BelongsTo
    {
        return $this->belongsTo(Recibo::class, 'recibo_id', 'id');
    }

    public function sessoesRef(): BelongsTo
    {
        return $this->belongsTo(Sessao::class, 'sessao_id', 'id');
    }

    public function lugareRef(): BelongsTo
    {
        return $this->belongsTo(Lugar::class, 'lugar_id', 'id');
    }
}
