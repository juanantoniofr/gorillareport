<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Models\Client;
use App\Models\Report;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        if (!empty($filter)) {
            $reports = Report::select('reports.*')
                ->join(DB::raw('(select max(updated_at) as max_date, client_id from reports group by client_id) as latest_reports'), function ($join) {
                    $join->on('reports.client_id', '=', 'latest_reports.client_id')
                    ->on('reports.updated_at', '=', 'latest_reports.max_date');
                })
                ->with('client')
                ->whereHas('client', function ($query) use ($filter) {
                    $query->where('name', 'like', '%'.$filter.'%');
                })
                ->orderBy('latest_reports.max_date', 'desc')
                ->paginate(10);
        } else {
           $reports = Report::select('reports.*')
                ->join(DB::raw('(select max(updated_at) as max_date, client_id from reports group by client_id) as latest_reports'), function ($join) {
                    $join->on('reports.client_id', '=', 'latest_reports.client_id')
                    ->on('reports.updated_at', '=', 'latest_reports.max_date');
                })
                ->with('client')
                ->orderBy('latest_reports.max_date', 'desc')
                ->paginate(10);


        }
        
        return view('reports.index')->with('reports', $reports)->with('filter', $filter);
    }
}