<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use App\Models\Client;
use Carbon\Carbon;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $clients = Client::sortable(['updated_at' => 'desc'])
                ->where('clients.name', 'like', '%'.$filter.'%')
                ->paginate(10);
        } else {
            $clients = Client::sortable(['updated_at' => 'desc'])
                ->paginate(10);
        }
        
        return view('clients.index')->with('clients', $clients)->with('filter', $filter);
    }
 
    public function show(Client $client)
    {
        return $client;
    }

    public function register(Request $request)
    {
        
        $client = Client::updateOrCreate(

            ['huid' =>  request('huid')],
        
            ['ip' =>  request('ip'), 'name' => request('name'), 'information' => request('information')]
        
        );

        return response()->json($client, 201);
        
    }

    public function update(Request $request, Client $client)
    {
        $client->update($request->all());

        return response()->json($article, 200);
    }

    public function delete(Client $client)
    {
        $client->delete();

        return response()->json(null, 204);
    }

}