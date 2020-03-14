<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientStorerequest;
use App\Http\Requests\ClientEditRequest;
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
            'name'=> $data['nome'],
            'cpf'=> preg_replace("/[^A-Za-z0-9]/", "", $data['cpf']),
            'email'=> $data['email'],
            'endereco'=> $data['end'] ?? null,
            'active_flag'=> isset($data['checkbox']) ? true : false,
        ]);
        return redirect()->route('client.index');        
    }

    public function destroy($id)
    {
        if(!empty($id)){
            $clientModel = app(Client::class);
            $client = $clientModel->find($id);
            if(!empty($client)){
                $client->delete();
                return response()->json([
                    'status'  => 'success',
                    'message' => 'Cliente deletado com sucesso.',
                    'reload'  => true,
                ]);
            }
            else{
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Cliente não encontrado.',
                    'reload'  => true,
                ]);
            }
            

        }
        else{
            return response()->json([
                'status'  => 'error',
                'message' => 'ID não está na requisição',
                'reload'  => true,
            ]);

        }
    }

    public function edit($id){
        $clientModel = app(Client::class);
        $client = $clientModel->find($id);
        return view('Clients/edit', compact('client'));
    }

    public function update(ClientEditRequest $request,$id){
        $data = $request->all();
        $clientModel = app(Client::class);
        $client = $clientModel->find($id);
        $client->update([
            'name'=> $data['nome'],
            'cpf'=>preg_replace("/[^A-Za-z0-9]/", "",$data['cpf']) ,
            'email'=>$data['email'],
            'endereco'=>$data['end'] ?? null,
            'active_flag'=> (($data['activebox'] ?? ' ') == null),
        ]);
        return redirect()->route('client.index');
    }

}
