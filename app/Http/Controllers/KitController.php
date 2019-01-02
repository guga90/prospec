<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Kit;
use App\Especialidade;
use App\Procedimento;
use App\Kitmatmed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class KitController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {

        $kits = DB::table('kits')
                ->select(array('kits.id', 'procedimentos.codigo', 'procedimentos.name'))
                ->join('procedimentos', 'kits.id_procedimento', '=', 'procedimentos.id')
                ->get();

        return view('kit.data', ['kits' => $kits, 'kitmatmeds' => array()]);
    }

    public function create() {

        $especialidades = Especialidade::all();
        $procedimentos = array();
        return view('kit.form', ['especialidades' => $especialidades, 'procedimentos' => $procedimentos]);
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kit = Kit::create($data);
        $this->createKitmatmed($kit->id, $data);

        return redirect()->route('kit')->with('message', 'Sucesso!');
    }

    public function createKitmatmed($kitId, $data) {

        DB::table('kitmatmeds')->where('id_kit', '=', $kitId)->delete();

        $dadossave = array('id_kit' => $kitId);
        foreach ($data['matmeds'] as $matmed) {

            $dadossave['id_matmed'] = $matmed['id_matmed'];
            $dadossave['quantidade'] = $matmed['quantidade'];
            Kitmatmed::create($dadossave);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {

        $validator = \Validator::make(
                        $data, ['id_procedimento' => 'required|int', 'id_especialidade' => 'required|int']
        );

        return $validator;
    }

    protected function formatToSave(array $data) {

        $matmeds = array();
        foreach ($data['matmed']['id_matmed'] as $k => $id_matmed) {
            $matmeds[] = array('quantidade' => $data['matmed']['quantidade'][$k], 'id_matmed' => $id_matmed);
        }

        $data['matmeds'] = $matmeds;

        return $data;
    }

    protected function formatToEdit($kit) {
        $kit->valor = 'R$ ' . number_format($kit->valor, 2, ',', '.');
        return $kit;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->createKitmatmed($id, $data);

        Kit::find($id)->update($data);
        return redirect()->route('kit')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        DB::table('kitmatmeds')->where('id_kit', '=', $id)->delete();
        Kit::find($id)->delete();
        return redirect()->route('kit')->with('message', 'Sucesso!');
    }

    public function edit($id) {

        $kit = Kit::findOrFail($id);
        $kit = $this->formatToEdit($kit);

        $especialidades = Especialidade::all();
        $procedimentos = DB::table('procedimentos')
                        ->select(array('procedimentos.id', DB::raw("CONCAT(codigo, ' - ' ,name) as name")))
                        ->where('procedimentos.id', '=', $kit->id_procedimento)->get();

        $kitmatmeds = DB::table('kitmatmeds')
                        ->select(array('kitmatmeds.id', 'kitmatmeds.id_matmed', DB::raw("CONCAT(IF(codigo_tuss = '', codigo_tiss, codigo_tuss), ' - ', nome_matmed, ' / ', nome_fabricante) as name_matmed"), 'kitmatmeds.quantidade'))
                        ->join('matmeds', 'kitmatmeds.id_matmed', '=', 'matmeds.id')
                        ->where('kitmatmeds.id_kit', '=', $id)->get();

        return view('kit.form')->with(array('kit' => $kit, 'especialidades' => $especialidades, 'procedimentos' => $procedimentos, 'kitmatmeds' => $kitmatmeds));
    }

}
