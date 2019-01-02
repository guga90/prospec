<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {
        $users = User::orderBy('created_at', 'desc')->paginate(10000);
        return view('user.data', ['users' => $users]);
    }

    public function create() {
                return view('user.form');
    }

    public function user(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::create($data);
        return redirect()->route('user')->with('sucess', 'Sucesso!');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {

        $validator = \Validator::make(
                        $data, ['cpf' => 'required|string|cpf']
        );

        return $validator;
    }

    protected function formatToSave(array $data) {
        
        $data['password'] = Hash::make($data['password']);
        return $data;
    }

    protected function formatToEdit($user) {
        return $user;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        User::find($id)->update($data);
        return redirect()->route('user')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        User::find($id)->delete();
        return redirect()->route('user')->with('sucess', 'Sucesso!');
    }

    public function edit($id) {

        $user = User::findOrFail($id);
        $user = $this->formatToEdit($user);
        return view('user.form')->with(array('user' => $user));
    }

}
