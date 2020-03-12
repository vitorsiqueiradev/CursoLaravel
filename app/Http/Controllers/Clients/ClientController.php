<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
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

    public function create(){
        $clientmodel = app(client::class);
        $client = $clientmodel->create([
            'name'=> 'nome teste2',
            'cpf'=> 123456780,
            'email'=> 'teste2@email.com',
            'active_flag'=> false,
        ]);

        dd($client);
    }
}
