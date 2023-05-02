<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'tel_cd_ddd',
        'tel_nu_telefone',
        'tel_id_pessoa',
    ];
}
