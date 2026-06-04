<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdemCarregamento extends Model
{
    protected $table = 'ordens_carregamento';
    
    protected $fillable = ['numero_oc', 'motorista_id', 'frota_id', 'destino_id', 'volume', 'peso_bruto', 'placas_utilizadas', 'pdf_path', 'numero_nf', 'status'];

    protected $casts = [
        'placas_utilizadas' => 'array',
    ];

    public function motorista()
    {
        return $this->belongsTo(Motorista::class);
    }

    public function frota()
    {
        return $this->belongsTo(Frota::class);
    }

    public function destino()
    {
        return $this->belongsTo(Destino::class);
    }
}
