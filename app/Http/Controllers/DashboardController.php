<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $search = $request->q;

        $kitmatmed = array();
        $procedimentos = array();
        $matmeds = array();

        if (strlen($search) > 0) {

            $kits = DB::table('kits')
                    ->select(array(
                        DB::raw("IF(codigo_tuss = '', codigo_tiss, codigo_tuss) as codigo_tiss_tuss"),
                        'matmeds.nome_fabricante as nome_fabricante',
                        'matmeds.nome_matmed',
                        'matmeds.nome_apresentacao',
                        'kitmatmeds.quantidade as quantidade_kit',
                        'matmeds.codigo_barras as codigo_barras',
                        'matmeds.codigo_reg_anvisa as codigo_anvisa',
                        'matmeds.generico as generico',
                        'matmeds.nome_matmed as nome_matmed',
                        'matmeds.preco as preco',
                        'matmeds.preco_fabrica as preco_fabrica',
                        'procedimentos.codigo as codigo_procedimento',
                        'procedimentos.name as nome_procedimento',
                        'procedimentos.valor as valor_procedimento',
                    ))
                    ->join('procedimentos', 'kits.id_procedimento', '=', 'procedimentos.id')
                    ->join('kitmatmeds', 'kitmatmeds.id_kit', '=', 'kits.id')
                    ->join('matmeds', 'kitmatmeds.id_matmed', '=', 'matmeds.id')
                    ->where('matmeds.codigo_matmed', '=', $search)
                    ->orWhere('matmeds.codigo_barras', '=', $search)
                    ->orWhere('matmeds.codigo_tuss', '=', $search)
                    ->orWhere('matmeds.codigo_tiss', '=', $search)
                    ->orWhere('matmeds.codigo_reg_anvisa', '=', $search)
                    ->orWhere('procedimentos.codigo', '=', $search)
                    ->orWhere('matmeds.nome_matmed', 'like', '%' . str_replace(' ','%', $search) . '%')
                    ->orWhere('procedimentos.name', 'like', '%' . str_replace(' ','%', $search) . '%')
                    ->orWhere('kits.info', 'like', '%' . $search . '%')
                    ->get();


            foreach ($kits as $k => $kit) {

                $kitmatmed[$kit->codigo_procedimento]['procedimento'] = $kit;
                $kitmatmed[$kit->codigo_procedimento]['matmeds'][$k] = $kit;
            }

            $procedimentos = DB::table('procedimentos')
                    ->select(array(
                        'procedimentos.codigo as codigo_procedimento',
                        'procedimentos.name as nome_procedimento',
                        'procedimentos.valor as valor_procedimento',
                    ))
                    ->where('procedimentos.codigo', '=', $search)
                    ->orWhere('procedimentos.name', 'like', '%' . str_replace(' ','%', $search) . '%')
                    ->get();

            $matmeds = DB::table('matmeds')
                    ->select(array(
                        DB::raw("IF(codigo_tuss = '', codigo_tiss, codigo_tuss) as codigo_tiss_tuss"),
                        'matmeds.nome_fabricante as nome_fabricante',
                        'nome_matmed',
                        'nome_apresentacao',
                        'matmeds.quantidade as quantidade_matmed',
                        'matmeds.codigo_barras as codigo_barras',
                        'matmeds.codigo_reg_anvisa as codigo_anvisa',
                        'matmeds.generico as generico',
                        'matmeds.preco as preco',
                        'matmeds.preco_fabrica as preco_fabrica',
                    ))
                    ->where('matmeds.codigo_matmed', '=', $search)
                    ->orWhere('matmeds.codigo_barras', '=', $search)
                    ->orWhere('matmeds.codigo_tuss', '=', $search)
                    ->orWhere('matmeds.codigo_tiss', '=', $search)
                    ->orWhere('matmeds.codigo_reg_anvisa', '=', $search)
                    ->orWhere('matmeds.nome_matmed', 'like', '%' . str_replace(' ','%', $search) . '%')
                    ->get();
        }

        return view('dashboard/index', ['search' => $search, 'kits' => $kitmatmed, 'procedimentos' => $procedimentos, 'matmeds' => $matmeds]);
    }

}
