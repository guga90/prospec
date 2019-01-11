<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\SmsCampanha;
use App\SmsCampanhaGrupo;
use App\Grupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SmscampanhaController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {

        $smscampanhas = Smscampanha::orderBy('created_at', 'desc')->paginate(10000);
        return view('smscampanha.data', ['smscampanhas' => $smscampanhas]);
    }

    public function create() {

        $grupos = Grupo::all();
        return view('smscampanha.form', ['grupos' => $grupos]);
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $smscampanha = Smscampanha::create($data);

        $this->createSmsCampanhaGrupos($smscampanha->id, $data);

        return redirect()->route('smscampanha')->with('sucess', 'Sucesso!');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {

        $validator = \Validator::make(
                        $data, ['name' => 'required|string']
        );

        return $validator;
    }

    protected function formatToSave(array $data) {
        $data['id_user'] = Auth::user()->id;
        return $data;
    }

    protected function formatToEdit($smscampanha) {
        return $smscampanha;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Smscampanha::find($id)->update($data);

        $this->createSmsCampanhaGrupos($id, $data);

        return redirect()->route('smscampanha')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        Smscampanha::find($id)->delete();
        return redirect()->route('smscampanha')->with('sucess', 'Sucesso!');
    }

    public function edit($id) {

        $smscampanha = Smscampanha::findOrFail($id);
        $smscampanha = $this->formatToEdit($smscampanha);

        $gruposactive = array();
        $grupos = Grupo::all();
        foreach ($grupos as $i => $grupo) {

            $clientsgrupos = DB::table('sms_campanha_grupos')->select()
                    ->where('sms_campanha_grupos.id_sms_campanha', '=', $id)
                    ->where('sms_campanha_grupos.id_grupo', '=', $grupo->id)
                    ->first();

            if (!empty($clientsgrupos->id)) {
                $grupo->active = true;
            } else {
                $grupo->active = false;
            }

            $gruposactive[] = $grupo;
        }

        return view('smscampanha.form')->with(array('smscampanha' => $smscampanha, 'grupos' => $gruposactive));
    }

    public function createSmsCampanhaGrupos($smsCampanhaId, $data) {

        DB::table('sms_campanha_grupos')->where('id_sms_campanha', '=', $smsCampanhaId)->delete();

        $dadossave = array('id_sms_campanha' => $smsCampanhaId);
        foreach ($data['id_grupo'] as $grupo) {
            $dadossave['id_grupo'] = $grupo;
            SmsCampanhaGrupo::create($dadossave);
        }
    }

}
