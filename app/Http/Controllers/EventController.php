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
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $events = Event::sortable(['updated_at' => 'desc'])
                ->where('clients.name', 'like', '%'.$filter.'%')
                ->paginate(10);
        } else {
            $events = Event::sortable(['updated_at' => 'desc'])
                ->paginate(10);
        }
        
        return view('events.index')->with('events', $events)->with('filter', $filter);
    }
}