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

class ListingController extends Controller
{

    public function software(Request $request)
    {
        return view('list.software');
    }

    public function hardware(Request $request)
    {
        return view('list.hardware');
    }

    public function SystemEvents(Request $request)
    {
        return view('list.SystemEvents');
    }
}