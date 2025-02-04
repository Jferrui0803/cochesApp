<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class CocheController extends Controller {

    private function asegurar($request, $name, $value){
       /* $x = $request->$name;
        if($x === null){
            $x = $value;
        }
        return $x;*/
        return $request->has($name) ? $request->$name : $value;
    }


    public function index(Request $request)  {
        //rpp - registros por página
        $rpps = [10, 20, 50, 100];
        $orderBy = $request->has('orderBy') ? $request->orderBy : '';
        $order = '';
        if($orderBy !== '') {
            $orderType = $request->has('orderType') ? $request->orderType : 'asc';
            $order =  $orderBy . ' ' . $orderType . ',' ;
        } 
        $orderType = 'asc';
        $rpp = $request->has('rpp') ? $request->rpp : 10;
        $page = $request->has('page') ? $request->page : 1;
        $offset = ($page - 1) * $rpp;
        $condition = '';
        if($request->has('q')){
            $q = $request->q;
           $condition = " and (c.id like '%$q%' or 
                            c.marca like '%$q%' or
                            c.modelo like '%$q%' or 
                            c.precio like '%$q%')";
        }
    
        $sql = "select * 
                from coche c
                where true $condition
                order by  $order  c.marca asc, c.modelo asc
                limit $offset , $rpp";
    
        $result = DB::select($sql);
        dd($result);
        
        $coches = Coche::paginate(10);
    
        return view('coche.index', compact('rpps', 'orderBy', 'orderType', 'rpp', 'q', 'coches'));
    }
}
