<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Client;
use App\Grupo;
use App\Clientsgrupos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {

        $clients = Client::orderBy('created_at', 'desc')->paginate(10000);
        return view('client.data', ['clients' => $clients]);
    }

    public function create() {

        $grupos = Grupo::all();
        return view('client.form', ['grupos' => $grupos]);
    }

    public function store(Request $request) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Client::create($data);

        $this->createClientgrupos($client->id, $data);

        return redirect()->route('client')->with('message', 'Sucesso!');
    }

    public function createClientgrupos($clientId, $data) {

        DB::table('clientsgrupos')->where('id_client', '=', $clientId)->delete();

        $dadossave = array('id_client' => $clientId);
        foreach ($data['id_grupo'] as $grupo) {
            $dadossave['id_grupo'] = $grupo;
            Clientsgrupos::create($dadossave);
        }
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

        $data['id_user'] = 1;

        return $data;
    }

    protected function formatToEdit($client) {
        return $client;
    }

    public function update(Request $request, $id) {

        $data = $this->formatToSave($request->all());

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $this->createClientgrupos($id, $data);

        Client::find($id)->update($data);
        return redirect()->route('client')->with('sucess', 'Sucesso!');
    }

    public function destroy($id) {

        DB::table('clientsgrupos')->where('id_client', '=', $id)->delete();
        Client::find($id)->delete();
        return redirect()->route('client')->with('message', 'Sucesso!');
    }

    public function edit($id) {

        $client = Client::findOrFail($id);
        $client = $this->formatToEdit($client);

        $gruposactive = array();
        $grupos = Grupo::all();
        foreach ($grupos as $i => $grupo) {

            $clientsgrupos = DB::table('clientsgrupos')->select()
                    ->where('clientsgrupos.id_client', '=', $id)
                    ->where('clientsgrupos.id_grupo', '=', $grupo->id)
                    ->first();

            if (!empty($clientsgrupos->id)) {
                $grupo->active = true;
            } else {
                $grupo->active = false;
            }
            
            $gruposactive[] = $grupo;
        }

        return view('client.form')->with(array('client' => $client, 'grupos' => $gruposactive));
    }

}
