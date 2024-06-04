<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'precio'];

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}