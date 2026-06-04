<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Placa extends Model
{
    protected $fillable = ['frota_id', 'tipo_placa', 'placa'];

    public function frota()
    {
        return $this->belongsTo(Frota::class);
    }
}
