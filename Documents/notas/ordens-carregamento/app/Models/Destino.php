<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destino extends Model
{
    protected $fillable = ['nome'];

    public function ordensCarregamento()
    {
        return $this->hasMany(OrdemCarregamento::class);
    }
}
