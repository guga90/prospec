<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\EmailServer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class EmailserverController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {

        $emailservers = EmailServer::orderBy('created_at', 'desc')->paginate(10000);
        return view('emailserver.data', ['emailservers' => $emailservers]);
    }

    public function create() {
        
        return view('emailserver.form');
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        EmailServer::create($data);
        return redirect()->route('emailserver')->with('sucess', 'Sucesso!');
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

    protected function formatToEdit($emailserver) {
        return $emailserver;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        EmailServer::find($id)->update($data);
        return redirect()->route('emailserver')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        EmailServer::find($id)->delete();
        return redirect()->route('emailserver')->with('sucess', 'Sucesso!');
    }

    public function edit($id) {

        $emailserver = EmailServer::findOrFail($id);
        $emailserver = $this->formatToEdit($emailserver);
        return view('emailserver.form')->with(array('emailserver' => $emailserver));
    }

}
