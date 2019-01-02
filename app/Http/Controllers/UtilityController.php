<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\CarBrand;
use App\CarModel;

class UtilityController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    public function listcarbrands() {
        return CarBrand::all();
    }

    public function listarprocedimentos(Request $request)
    {
        $query = $request->q;
                
        return DB::table('procedimentos')
                ->select(array('id', DB::raw("CONCAT(codigo, ' - ' ,name) as text")))
                ->where('codigo', '=', $query['term'])
                ->orWhere('name', 'like', '%' .$query['term']. '%')
                ->limit(20)->get();
    }

    public function listarmatmeds(Request $request)
    {
        $query = $request->q;
                
        return DB::table('matmeds')
                ->select(array('id', DB::raw("CONCAT(IF(codigo_tuss = '', codigo_tiss, codigo_tuss), ' - ' ,nome_matmed , ' / ', nome_fabricante) as text")))
                ->where('codigo_matmed', '=', $query['term'])
                ->orWhere('codigo_tuss', '=', $query['term'])
                ->orWhere('codigo_tiss', '=', $query['term'])
                ->orWhere('nome_matmed', 'like', '%' .$query['term']. '%')
                ->orWhere('nome_fabricante', 'like', '%' .$query['term']. '%')
                ->limit(50)->get();
    }

}
