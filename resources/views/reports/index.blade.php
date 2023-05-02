@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12 py-3">
            <h1>Report List</h1>
        </div>
        <div class="col-md-12">
            <form method="GET">
            <div class="col align-items-end d-flex flex-column mb-3">
                <div class="d-flex flex-column ">
                    <label for="filter" class="form-label">Filter</label>
                    <input type="text" class="form-control" id="filter" name="filter" placeholder="Client name..." value="{{ $filter ?? '' }}">
                    <span id="passwordHelpInline" class="form-text">
                            Type the whole or part of the name and press enter.
                    </span>
                    
                </div>
            </div>
                <!-- <button type="submit" class="btn btn-default mb-2">Filter</button> -->
            </form>
        </div>
        
        <div class="col-md-12 table-responsive"> 
            <table class="table align-middle">
                <thead>
                    <tr class="table-dark">
                        <!-- <th class="col-1">ID</th> -->
                        <th class="p-3" >@sortablelink('updated_at')</th>
                        <th class="p-3" >@sortablelink('client.name','Hostname')</th>
                        <th class="p-3">Report</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                    <tr>
                        <td class="p-3">{{$report->updated_at}}</td>
                        <td class="p-3"><a href="{{ route('clients.show',$report->client->id) }}"> {{$report->client->name}} </a></td>
                        <td class="p-3">
                            <a href="{{ route('clients.show_report',$report->client) }}"> View last report</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $reports->appends(\Request::except('page'))->render() !!}
    </div>
</div>
@endsection    