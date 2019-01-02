<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Fabricante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class FabricanteController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {

        $fabricantes = Fabricante::orderBy('created_at', 'desc')->paginate(10000);
        return view('fabricante.data', ['fabricantes' => $fabricantes]);
    }

    public function create() {
        
        return view('fabricante.form');
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Fabricante::create($data);
        return redirect()->route('fabricante')->with('sucess', 'Sucesso!');
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

    protected function formatToEdit($fabricante) {
        return $fabricante;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Fabricante::find($id)->update($data);
        return redirect()->route('fabricante')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        Fabricante::find($id)->delete();
        return redirect()->route('fabricante')->with('sucess', 'Sucesso!');
    }

    public function edit($id) {

        $fabricante = Fabricante::findOrFail($id);
        $fabricante = $this->formatToEdit($fabricante);
        return view('fabricante.form')->with(array('fabricante' => $fabricante));
    }

}
