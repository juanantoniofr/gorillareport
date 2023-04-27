<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;


use App\Models\Client;
use App\Models\Event;
use App\Models\Report;
use Carbon\Carbon;
use Carbon\CarbonInterval;

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
    public function index()
    {
        $clients = Client::all();
        //Activity
        $numClients = Client::all()->count();
        $now = Carbon::now(); 
        $minutes = Carbon::now()->subMinutes(15)->format('Y-m-d H:i:s');
        $activeClients = Client::whereDate('updated_at', '>=', Carbon::now()->subMinutes(15) )->count();


        
        //Obtener los 10 clientes más reciemtemte actualizados
        $lastmodify_clients = Client::orderBy('updated_at', 'desc')->take(1)->get();
        
        //events
        $events = Event::all(); 

        //Hash_errors
        $hash_errors = array();
        $reports = Report::all();
        /*foreach (json_decode($reports->managed_install) as $task){
            if ( !empty( json_decode($task->hash_error) ) )
                $hash_errors[$task] = $task->hash_error;
        }*/
        

        return view('home',compact('numClients','activeClients','now', 'minutes', 'clients','events'));
    }

    
}
