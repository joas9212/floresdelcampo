<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    protected $fillable = ['nombre', 'email'];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}