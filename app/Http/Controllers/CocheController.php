<?php

namespace App\Http\Controllers;

use App\Models\Coche;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class CocheController extends Controller {

    const ORDER_BY = ['marca', 'id', 'modelo', 'precio'];
    const ORDER_TYPE = ['asc', 'desc'];
    const RPPS = [10, 20, 50, 100];

    private function checkValue($name, $values, $request) {
        $v = $request->has($name) ? $request->$name : $values[0];
        return !in_array($v, $values) ? $values[0] : $v;
    }

    private function orderBy($request) {
        return $this->checkValue('orderBy', self::ORDER_BY, $request);
    }

    private function orderType($request) {
        return $this->checkValue('orderType', self::ORDER_TYPE, $request);
    }

    private function rpp($request) {
        return $this->checkValue('rpp', self::RPPS, $request);
    }

    public function index(Request $request) {
        //Number::useLocale('es');
        $rpps = [10, 20, 50, 100];
        $orderBy = $this->orderBy($request);
        $order = '';
        if($orderBy !== '') {
            $orderType = $this->orderType($request);
            $order = $orderBy . ' ' . $orderType . ', ';
        }
        $rpp = $this->rpp($request);
        $page = $request->has('page') ? $request->page : 1;
        if(!is_numeric($page)) {
            $page = 1;
        }
        $offset = ($page - 1) * $rpp;
        $condition = '';
        $params = [];
        $q = '';
        if($request->has('q')) {
            $q = $request->q;
            $condition = 'and id like :q1 or
	                        marca like :q2 or
	                        modelo like :q3 or
	                        precio like :q4';
            $params = [
                'q1' => "%$q%",
                'q2' => "%$q%",
                'q3' => "%$q%",
                'q4' => "%$q%",
            ];
        }
        $sql = "select *
                from coche 
                where true $condition
                order by $order marca asc, modelo asc
                limit $offset , $rpp";

        $coches = DB::select($sql, $params);
        $sql = "select count(*) total 
                from coche  
                where true $condition";
        $count = DB::select($sql, $params);
        $total = $count[0]->total;
        $coches = new LengthAwarePaginator($coches, $total, $rpp, null, ['path' => url('')]);

        // $coches = Coche::paginate(10);
        // dd($paginator, $coches);

        $coche = new Coche();
        if ($request->has('q')){
            $coche = $coche->where('id', 'like', "%$q%")
                            ->orWhere('marca', 'like', "%$q%")
                            ->orWhere('modelo', 'like', "%$q%")
                            ->orWhere('precio', 'like', "%$q%");
        }

        if ($order != '') {
            $coche = $coche->orderBy($orderBy, $orderType);
        }
        $coche = $coche->orderBy('marca', 'asc');
        $coche = $coche->orderBy('modelo', 'asc');

        $vehiculos = $coche->paginate($rpp);

       

        return view('coche.index', compact('coches', 'orderBy', 'orderType', 'q', 'rpp', 'rpps', 'vehiculos'));
    }
}
