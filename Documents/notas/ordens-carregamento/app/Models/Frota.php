<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frota extends Model
{
    protected $fillable = ['numero_frota', 'tipo', 'volume', 'peso_bruto'];

    public function placas()
    {
        return $this->hasMany(Placa::class);
    }

    public function ordensCarregamento()
    {
        return $this->hasMany(OrdemCarregamento::class);
    }
}
