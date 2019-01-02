<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Tmatmed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class TmatmedController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {

        $tmatmeds = Tmatmed::orderBy('created_at', 'desc')->paginate(10000);
        return view('tmatmed.data', ['tmatmeds' => $tmatmeds]);
    }

    public function create() {
        
        return view('tmatmed.form');
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Tmatmed::create($data);
        return redirect()->route('tmatmed')->with('sucess', 'Sucesso!');
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

    protected function formatToEdit($tmatmed) {
        return $tmatmed;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Tmatmed::find($id)->update($data);
        return redirect()->route('tmatmed')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        Tmatmed::find($id)->delete();
        return redirect()->route('tmatmed')->with('sucess', 'Sucesso!');
    }

    public function edit($id) {

        $tmatmed = Tmatmed::findOrFail($id);
        $tmatmed = $this->formatToEdit($tmatmed);
        return view('tmatmed.form')->with(array('tmatmed' => $tmatmed));
    }

}
