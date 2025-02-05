<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class CocheController extends Controller {

    private function checkValue($name, $values, $value, $request) {
        $v = $request->has($name) ? $request->$name : $value;
        return !in_array($v, $values) ? $value : $v;
    }

    private function orderBy($request) {
        $fields = ['c.id', 'c.marca', 'c.modelo', 'c.precio'];
        $defaultField = '';
        return $this->checkValue('orderBy', $fields, $defaultField,$request);  
    }

    private function orderType($request) {
        $values = ['asc', 'desc'];
        $defaultValue = 'asc';
        return $this->checkValue('orderType', $values, $defaultValue,$request);
    }

    private function rpp($request) {
        $values = [5, 10, 20, 50, 100];
        $defaultValue = '10';
        return $this->checkValue('rpp', $values, $defaultValue,$request);
    }


    public function index(Request $request)  {
        //rpp - registros por página
        $rpps = [10, 20, 50, 100];
        $orderBy = $this->orderBy($request);
        $order = '';
        if($orderBy !== '') {
            $orderType = $this->orderType($request);
            $order =  $orderBy . ' ' . $orderType . ',' ;
        } 
        $orderType = 'asc';
        $rpp = $this->rpp($request);
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
