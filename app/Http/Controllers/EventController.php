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


        if ($request->filled('error')) {
            $query->where('error', '>', 0);
        } elseif ($request->filled('warning')) {
            $query->where('warning', '>' , 0);
        } elseif ($request->filled('successful')) {
            $query->where('successful', '>' , 0);
        }

    
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $events = $query->where('clients.name', 'like', '%'.$filter.'%')
                ->paginate(5);
        } else {
            $events = $query->paginate(5);
        }

        
        return view('events.index')->with('events', $events)->with('filter', $filter);
    }

}