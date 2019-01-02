<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Tprocedimento;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class TprocedimentoController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {

        $tprocedimentos = Tprocedimento::orderBy('created_at', 'desc')->paginate(10000);
        return view('tprocedimento.data', ['tprocedimentos' => $tprocedimentos]);
    }

    public function create() {
        
        return view('tprocedimento.form');
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Tprocedimento::create($data);
        return redirect()->route('tprocedimento')->with('sucess', 'Sucesso!');
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

    protected function formatToEdit($tprocedimento) {
        return $tprocedimento;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Tprocedimento::find($id)->update($data);
        return redirect()->route('tprocedimento')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        Tprocedimento::find($id)->delete();
        return redirect()->route('tprocedimento')->with('sucess', 'Sucesso!');
    }

    public function edit($id) {

        $tprocedimento = Tprocedimento::findOrFail($id);
        $tprocedimento = $this->formatToEdit($tprocedimento);
        return view('tprocedimento.form')->with(array('tprocedimento' => $tprocedimento));
    }

}
