<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index(Request $request)
    {
        // Obtener los valores de sort y direction de los parámetros de la solicitud
        $sort = $request->query('sort', 'updated_at');
        $direction = $request->query('direction', 'desc');

        $query = Event::join('reports', 'events.report_id', '=', 'reports.id')
            ->join('clients', 'reports.client_id', '=', 'clients.id')
            ->select('events.*', 'clients.name as client_name', 'clients.id as client_id')
            ->orderBy($sort, $direction == 'asc' ? 'asc' : 'desc');

        
        // Si existe el parámetro client_name en la solicitud
        if( $request->filled('client_name')  && !empty($request->query('client_name')) ) {
            // Se agrega una cláusula where que busca el nombre del cliente en la tabla clients
            $client_name = $request->query('client_name');
            $query->where('clients.name', 'like', "%$client_name%");
        }
        
       
        if ($request->filled('error')) {
            $query->where('error', '>', 0);
        }
        if ($request->filled('warning')) {
            $query->where('warning', '>', 0);
        }
        if ($request->filled('successful')) {
            $query->where('successful', '>', 0);
        }
        $events = $query->paginate(5); 


        
        
        // Guarda los parámetros en la sesión
        $request->session()->flashInput($request->input());
        return view('events.index')->with('events', $events);
    }

}