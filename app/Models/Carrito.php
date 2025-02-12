<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model {

    protected $table = 'carrito';

    protected $fillable = ['session', 'user_id'];

    public function detalles() {
        return $this->hasMany('App\Models\CarritoDetalle', 'carrito_id');
    }

    public function user() {
        return $this->belongsTo ('App\Models\User', 'user_id');
    }
}