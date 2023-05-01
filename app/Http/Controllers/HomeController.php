<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;


use App\Models\Client;
use App\Models\Event;
use App\Models\Report;
use Carbon\Carbon;
use Carbon\CarbonInterval;

use App\Http\Controllers\ReportController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ReportController $reportController, Request $request)
    {
        $clients = Client::all();
        
        //Activity
        $numClients = Client::all()->count();
        $now = Carbon::now(); 
        $minutes = Carbon::now()->subMinutes(15)->format('Y-m-d H:i:s');
        $activeClients = Client::whereDate('updated_at', '>=', Carbon::now()->subMinutes(15) )->count();

        
        //last events
        $last_events = $reportController->get_lastEvents($request);

        

        return view('home',compact('numClients','activeClients','now', 'minutes', 'clients','last_events'));
    }

    
}
