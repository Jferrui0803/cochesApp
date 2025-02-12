<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Coche;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarritoController extends Controller {

    function add(Request $request, Coche $coche) {
        $value = session('carrito');
        if($value === null) {
            //session(['carrito' => true ]);
            $user = $request->user();
            $carrito = new Carrito();
            $carrito->user_id = null;
            if($user !== null) {
                $carrito->user_id = $user->id;
            }
            $carrito->session=(string) Str::uuid();
            dd($carrito);
        }
        dd($value);
        dd($coche);
    }
}
