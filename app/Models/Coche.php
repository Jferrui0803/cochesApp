<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coche extends Model {
    protected $table = 'coche';

    //rellenable masivamente
    protected $fillable = ['marca', 'modelo', 'precio'];

    public function detalles() {
        return $this->hasMany('App\Models\CarritoDetalle', 'carrito_id');
    }
}
