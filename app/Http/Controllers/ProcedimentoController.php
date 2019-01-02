<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Procedimento;
use App\Tprocedimento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProcedimentoController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
// $this->middleware('auth');
    }

    public function index() {
        return view('procedimento.data');
    }

    public function create() {

        $tprocedimentos = Tprocedimento::all();
        return view('procedimento.form', ['tprocedimentos' => $tprocedimentos]);
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Procedimento::create($data);
        return redirect()->route('procedimento')->with('sucess', 'Sucesso!');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {

        $validator = \Validator::make(
                        $data, ['name' => 'required|string', 'id_tprocedimento' => 'required|int']
        );

        return $validator;
    }

    protected function formatToSave(array $data) {
        if (!empty($data['valor'])) {
            $data['valor'] = str_replace(array(','), '.', str_replace(array('R$ ', '.'), '', $data['valor']));
        } else {
            $data['valor'] = 0;
        }
        return $data;
    }

    protected function formatToEdit($procedimento) {
        $procedimento->valor = 'R$ ' . number_format($procedimento->valor, 2, ',', '.');
        return $procedimento;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Procedimento::find($id)->update($data);
        return redirect()->route('procedimento')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        Procedimento::find($id)->delete();
        return redirect()->route('procedimento')->with('sucess', 'Sucesso!');
    }

    public function edit($id) {

        $procedimento = Procedimento::findOrFail($id);
        $procedimento = $this->formatToEdit($procedimento);
        $tprocedimentos = Tprocedimento::all();
        return view('procedimento.form')->with(array('procedimento' => $procedimento, 'tprocedimentos' => $tprocedimentos));
    }

    public function listar(Request $request) {

        $param = $request->all();

        $paginacao = $param['draw'] * 100;

        $query = Procedimento::query();

        if (!empty($param['search']['value'])) {
            $query->where('codigo', '=', $param['search']['value'])
                    ->orWhere('name', 'like', '%' . $param['search']['value'] . '%');
        }

        foreach ($param["order"] as $order) {
            if ($order["column"] == '0') {
                $query->orderBy('codigo', $order["dir"]);
            }
            if ($order["column"] == '1') {
                $query->orderBy('name', $order["dir"]);
            }
            if ($order["column"] == '2') {
                $query->orderBy('status', $order["dir"]);
            }
        }

        $procedimentos = $query->paginate($paginacao);

        $jsonArray = array();
        foreach ($procedimentos as $procedimento) {

            $jsonArray[] = array(
                'codigo' => $procedimento->codigo,
                'name' => $procedimento->name,
                'status' => ($procedimento->status == 'A' ? 'Ativo' : 'Inativo'),
                'btn' => '<div class="row">
                            <a class="btn btn-primary btn-sm" href="' . url('/') . '/procedimento/' . $procedimento->id . '/edit"><i class="glyphicon glyphicon-pencil"></i></a>
                            <form id="" method="POST" action="' . url('/') . '/procedimento/' . $procedimento->id . '" style="display: inline;">' . csrf_field() . '
                                ' . method_field("DELETE") . ' 
                                <input name="id" type="hidden" value="' . $procedimento->id . '">  
                                <button type="submit" style="" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>
                            </form>
                        </div>',
            );
        }

        echo json_encode(array(
            "draw" => $param['draw'],
            "recordsTotal" => $procedimentos->total(),
            "recordsFiltered" => $procedimentos->total(),
            'data' => $jsonArray
                )
        );
    }

}
