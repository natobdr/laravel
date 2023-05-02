<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'end_tp_endereco',
        'end_nm_logradouro',
        'end_ds_complemento',
        'end_nu_imovel',
        'end_nm_bairro',
        'end_nu_cep',
        'end_ds_cidade',
        'end_ds_estado',
    ];
}
