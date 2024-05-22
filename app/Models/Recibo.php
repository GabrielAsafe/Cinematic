<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{

    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['cliente_id', 'data', 'preco_total_sem_iva', 'preco_total_com_iva', 'iva','nif',
        'nome_cliente', 'tipo_pagamento','recibo_pdf_url','custom'];

}
