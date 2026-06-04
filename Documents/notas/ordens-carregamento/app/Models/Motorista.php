<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motorista extends Model
{
    protected $fillable = ['nome', 'cpf'];

    public function ordensCarregamento()
    {
        return $this->hasMany(OrdemCarregamento::class);
    }
}
