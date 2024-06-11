<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ciudad extends Model
{

    protected $table = 'ciudades';

    protected $fillable = ['nombre', 'pais_id'];

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class);
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}