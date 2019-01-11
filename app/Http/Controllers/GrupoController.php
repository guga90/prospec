<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Grupo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class GrupoController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {

        $grupos = Grupo::orderBy('created_at', 'desc')->paginate(10000);
        return view('grupo.data', ['grupos' => $grupos]);
    }

    public function create() {
        
        return view('grupo.form');
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Grupo::create($data);
        return redirect()->route('grupo')->with('sucess', 'Sucesso!');
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

    protected function formatToEdit($grupo) {
        return $grupo;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Grupo::find($id)->update($data);
        return redirect()->route('grupo')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        Grupo::find($id)->delete();
        return redirect()->route('grupo')->with('sucess', 'Sucesso!');
    }

    public function edit($id) {

        $grupo = Grupo::findOrFail($id);
        $grupo = $this->formatToEdit($grupo);
        return view('grupo.form')->with(array('grupo' => $grupo));
    }

}
