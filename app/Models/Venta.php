<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['producto_id', 
                            'user_id',
                            'cliente_id', 
                            'ciudad_id', 
                            'Comprobante_id',
                            'precio',
                            'cantidad',
                            'metodo_pago',
                            'valor_total', 
                            'estado'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    
    public function metodo_pago()
    {
        return $this->belongsTo(MetodoPago::class);
    }
    
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class);
    }

    public function pedido()
    {
        return $this->hasOne(Pedido::class);
    }

    public function comprobantes()
    {
        return $this->hasMany(Comprobante::class);
    }
}