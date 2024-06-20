<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    
    protected $fillable = ['nombre', 'email'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}