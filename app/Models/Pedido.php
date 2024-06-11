<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = ['venta_id', 'proveedor_id', 'ciudad_id',  'estado'];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }
}