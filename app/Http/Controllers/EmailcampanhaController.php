<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\EmailCampanha;
use App\EmailCampanhaGrupo;
use App\Grupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class EmailcampanhaController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {

        $emailcampanhas = Emailcampanha::orderBy('created_at', 'desc')->paginate(10000);
        return view('emailcampanha.data', ['emailcampanhas' => $emailcampanhas]);
    }

    public function create() {

        $grupos = Grupo::all();
        return view('emailcampanha.form', ['grupos' => $grupos]);
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $emailcampanha = Emailcampanha::create($data);

        $this->createEmailCampanhaGrupos($emailcampanha->id, $data);

        return redirect()->route('emailcampanha')->with('sucess', 'Sucesso!');
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

        return $data;
    }

    protected function formatToEdit($emailcampanha) {
        return $emailcampanha;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Emailcampanha::find($id)->update($data);

        $this->createEmailCampanhaGrupos($id, $data);

        return redirect()->route('emailcampanha')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        Emailcampanha::find($id)->delete();
        return redirect()->route('emailcampanha')->with('sucess', 'Sucesso!');
    }

    public function edit($id) {

        $emailcampanha = Emailcampanha::findOrFail($id);
        $emailcampanha = $this->formatToEdit($emailcampanha);

        $gruposactive = array();
        $grupos = Grupo::all();
        foreach ($grupos as $i => $grupo) {

            $clientsgrupos = DB::table('email_campanha_grupos')->select()
                    ->where('email_campanha_grupos.id_email_campanha', '=', $id)
                    ->where('email_campanha_grupos.id_grupo', '=', $grupo->id)
                    ->first();

            if (!empty($clientsgrupos->id)) {
                $grupo->active = true;
            } else {
                $grupo->active = false;
            }

            $gruposactive[] = $grupo;
        }

        return view('emailcampanha.form')->with(array('emailcampanha' => $emailcampanha, 'grupos' => $gruposactive));
    }

    public function createEmailCampanhaGrupos($emailCampanhaId, $data) {

        DB::table('email_campanha_grupos')->where('id_email_campanha', '=', $emailCampanhaId)->delete();

        $dadossave = array('id_email_campanha' => $emailCampanhaId);
        foreach ($data['id_grupo'] as $grupo) {
            $dadossave['id_grupo'] = $grupo;
            EmailCampanhaGrupo::create($dadossave);
        }
    }

}
