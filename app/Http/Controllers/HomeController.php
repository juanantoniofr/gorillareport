<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;


use App\Models\Client;
use App\Models\Event;
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


        //UpTime < 1d
        $UpTimeclients_1d = $clients->filter(function($client, $key){
            
            $information = json_decode($client->information);
            if (!isset($information->OsUptime))
                return false;
            $strDateUpTime = Carbon::createFromTimestamp($information->OsUptime, 'Europe/Madrid');
            $strDateInit = Carbon::createFromFormat('Y-m-d H:i:s', '1970-01-01 00:00:00');
            $diffInDays = $strDateUpTime->diffInDays($strDateInit);
            
            if ($diffInDays > 1)
                return true;
            
        })->count();

        
        //Obtener los 10 clientes más reciemtemte actualizados
        $lastmodify_clients = Client::orderBy('updated_at', 'desc')->take(1)->get();
        
        //events
        $events = Event::all(); 
        

        return view('home',compact('numClients','activeClients','now', 'minutes', 'clients','UpTimeclients_1d','events'));
    }

    
}
