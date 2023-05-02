<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'pes_nome',
        'pes_nu_cpf',
        'pes_nu_rg',
        'pes_tp_pessoa',
    ];

    public function telefone()
    {
        return $this->belongsTo(Telefone::class, 'id');
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class,'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

}
