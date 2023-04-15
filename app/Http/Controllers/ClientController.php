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
        #decodificar el campo report
        $report = json_decode($client->report, true);

        return  view('clients.show')->with('client', $client)->with('report', $report);  
    }

    public function show_report(Client $client)
    {
        #decodificar el campo report
        $report = json_decode($client->report);

        return  view('clients.show_report')->with('client', $client)->with('report', $report);  
    }


    public function register(Request $request)
    {
        
        $client = Client::updateOrCreate(

            ['huid' =>  request('huid')],
        
            ['ip' =>  request('ip'), 'name' => request('name')]
        
        );

        return response()->json($client, 201);
        
    }

    /*
    Actualizamds el campo information del modelo client los valores recibidos en el request
    */
    public function updateBasicInformation(Request $request)
    {
        #Obtenemos los datos del request
        $data = $request->all();
        #Buscamos el cliente por su huid
        $client = Client::where('huid', $data['huid'])->first();
        #Actualizamos el campo information
        $result = $client->update
        (
            [
                'information' => $data['information']
            ]
        );
        #Devolvemos el resultado
        if ($result) {
            return response()->json($client, 200);
        } else {
            return response()->json(null, 400);
        }
    }

    /* actualizamos el campo report del modelo client con los valores recibidos en el request */
    public function updateReport(Request $request)
    {
        #Obtenemos los datos del request
        $data = $request->all();
        #Buscamos el cliente por su huid
        $client = Client::where('huid', $data['huid'])->first();
        #Actualizamos el campo report
        $result = $client->update
        (
            [
                'report' => $data['report']
            ]
        );
        #Devolvemos el resultado
        if ($result) {
            return response()->json($client, 200);
        } else {
            return response()->json(null, 400);
        }
    }
    
    public function update(Request $request, Client $client)
    {
        $client->update($request->all());

        return response()->json($client, 200);
    }

    public function delete(Client $client)
    {
        $client->delete();

        return response()->json(null, 204);
    }

}