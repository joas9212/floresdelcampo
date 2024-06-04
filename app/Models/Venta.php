<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['producto_id', 'vendedor_id', 'precio', 'estado'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class);
    }

    public function pedido()
    {
        return $this->hasOne(Pedido::class);
    }
}