<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\SmsServer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class SmsserverController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {

        $smsservers = SmsServer::orderBy('created_at', 'desc')->paginate(10000);
        return view('smsserver.data', ['smsservers' => $smsservers]);
    }

    public function create() {
        
        return view('smsserver.form');
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        SmsServer::create($data);
        return redirect()->route('smsserver')->with('sucess', 'Sucesso!');
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

    protected function formatToEdit($smsserver) {
        return $smsserver;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        SmsServer::find($id)->update($data);
        return redirect()->route('smsserver')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        SmsServer::find($id)->delete();
        return redirect()->route('smsserver')->with('sucess', 'Sucesso!');
    }

    public function edit($id) {

        $smsserver = SmsServer::findOrFail($id);
        $smsserver = $this->formatToEdit($smsserver);
        return view('smsserver.form')->with(array('smsserver' => $smsserver));
    }

}
