<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ciudad extends Model
{
    protected $fillable = ['nombre', 'pais_id'];

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }
}