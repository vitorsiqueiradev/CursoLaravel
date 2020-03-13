<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientStorerequest;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index(){
        $clientmodel = app(client::class);

        $clients = $clientmodel->all();

        //$clients = $clientmodel->find(1);

        //$clients = $clientmodel->where('cpf', 123456780)->get();

        //dd($clients);


        return view('Clients/index',compact('clients'));
    }

    public function create(ClientStorerequest $request){
        return view('Clients/create');


        //$clientmodel = app(client::class);
        //$client = $clientmodel->create([
            //'name'=> 'nome teste2',
            //'cpf'=> 123456780,
            //'email'=> 'teste2@email.com',
            //'active_flag'=> false,
        //]);
        //dd($client);
    }

    public function store(ClientStorerequest $request){
        $data = $request->all();
        $clientModel = app(Client::class);
        $client = $clientModel->create([
            'nome'=> $data['nome'],
            'cpf'=> preg_replace("/[A-Za-z0-9]/", "", $data['cpf']),
            'email'=> $data['email'],
            'end'=> $data['end'] ?? null,
            'active_flag'=> isset($data['checkbox']) ? true : false,
        ]);
        return redirect()->route('clients.index');        
    }
}
