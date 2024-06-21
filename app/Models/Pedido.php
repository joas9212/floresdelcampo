<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['venta_id', 
                            'proveedor_id', 
                            'ciudad_id',  
                            'estado',
                            'nombre_destinatario',
                            'numero_contacto_destinatario',
                            'direccion_destionatario',
                            'mensaje_dedicatoria',
                            'observaciones',
                            'fecha_envio',
                            'costo_envio',];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }
}