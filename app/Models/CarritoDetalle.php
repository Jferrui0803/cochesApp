<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarritoDetalle extends Model {

    protected $table = 'carritodetalle';

    protected $fillable = ['cantidad', 'carrito_id', 'coche_id'];

    public function carrito() {
        return $this->belongsTo ('App\Models\Carrito', 'carrito_id');
    }

    public function coche() {
        return $this->belongsTo ('App\Models\Coche', 'coche_id');
    }
}