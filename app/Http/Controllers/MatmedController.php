<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Matmed;
use App\Tmatmed;
use App\Fabricante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MatmedController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {
        return view('matmed.data');
    }

    public function create() {

        $tmatmeds = Tmatmed::all();
        $fabricantes = Fabricante::all();
        return view('matmed.form', ['tmatmeds' => $tmatmeds, 'fabricantes' => $fabricantes]);
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Matmed::create($data);
        return redirect()->route('matmed')->with('sucess', 'Sucesso!');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {

        $validator = \Validator::make(
                        $data, ['codigo_matmed' => 'required|string', 'nome_matmed' => 'required|string']
        );

        return $validator;
    }

    protected function formatToSave(array $data) {
        if (!empty($data['preco'])) {
            $data['preco'] = str_replace(array(','), '.', str_replace(array('R$ ', '.'), '', $data['preco']));
        } else {
            $data['preco'] = 0;
        }
        return $data;
    }

    protected function formatToEdit($matmed) {
        $matmed->preco = 'R$ ' . number_format($matmed->preco, 2, ',', '.');
        return $matmed;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Matmed::find($id)->update($data);
        return redirect()->route('matmed')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        Matmed::find($id)->delete();
        return redirect()->route('matmed')->with('sucess', 'Sucesso!');
    }

    public function edit($id) {

        $matmed = Matmed::findOrFail($id);
        $matmed = $this->formatToEdit($matmed);
        $tmatmeds = Tmatmed::all();
        $fabricantes = Fabricante::all();
        return view('matmed.form')->with(array('matmed' => $matmed, 'tmatmeds' => $tmatmeds, 'fabricantes' => $fabricantes));
    }

    public function listar(Request $request) {

        $param = $request->all();

        $paginacao = $param['draw'] * 100;

        $query = Matmed::query();

        if (!empty($param['search']['value'])) {
            $query->where('codigo_matmed', '=', $param['search']['value'])
                    ->orWhere('nome_matmed', 'like', '%' . $param['search']['value'] . '%');
        }

        foreach ($param["order"] as $order) {
            if ($order["column"] == '0') {
                $query->orderBy('codigo_matmed', $order["dir"]);
            }
            if ($order["column"] == '1') {
                $query->orderBy('nome_matmed', $order["dir"]);
            }
            if ($order["column"] == '2') {
                $query->orderBy('status', $order["dir"]);
            }
        }

        $matmeds = $query->paginate($paginacao);

        $jsonArray = array();
        foreach ($matmeds as $matmed) {

            $jsonArray[] = array(
                'codigo' => $matmed->codigo_matmed,
                'name' => $matmed->nome_matmed,
                'status' => ($matmed->status == 'A' ? 'Ativo' : 'Inativo'),
                'btn' => '<div class="row">
                            <a class="btn btn-primary btn-sm" href="' . url('/') . '/matmed/' . $matmed->id . '/edit"><i class="glyphicon glyphicon-pencil"></i></a>
                            <form id="" method="POST" action="' . url('/') . '/matmed/' . $matmed->id . '" style="display: inline;">' . csrf_field() . '
                                ' . method_field("DELETE") . ' 
                                <input name="id" type="hidden" value="' . $matmed->id . '">  
                                <button type="submit" style="" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></button>
                            </form>
                        </div>',
            );
        }

        echo json_encode(array(
            "draw" => $param['draw'],
            "recordsTotal" => $matmeds->total(),
            "recordsFiltered" => $matmeds->total(),
            'data' => $jsonArray
                )
        );
    }

}
