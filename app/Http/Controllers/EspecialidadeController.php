<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Especialidade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class EspecialidadeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {

        $especialidades = Especialidade::orderBy('created_at', 'desc')->paginate(10000);
        return view('especialidade.data', ['especialidades' => $especialidades]);
    }

    public function create() {
        
        return view('especialidade.form');
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Especialidade::create($data);
        return redirect()->route('especialidade')->with('sucess', 'Sucesso!');
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

    protected function formatToEdit($especialidade) {
        return $especialidade;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Especialidade::find($id)->update($data);
        return redirect()->route('especialidade')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        Especialidade::find($id)->delete();
        return redirect()->route('especialidade')->with('sucess', 'Sucesso!');
    }

    public function edit($id) {

        $especialidade = Especialidade::findOrFail($id);
        $especialidade = $this->formatToEdit($especialidade);
        return view('especialidade.form')->with(array('especialidade' => $especialidade));
    }

}
