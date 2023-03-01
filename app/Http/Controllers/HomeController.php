<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Client;
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

        return view('home',compact('numClients','activeClients'));
    }
}
