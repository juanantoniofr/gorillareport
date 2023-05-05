@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12 py-3">
            <h1>Summary List</h1>
        </div>
        <div class="col-md-12">
            <form method="GET">
            <!-- <form method="GET" action="{{ url('events') }}"> -->
                <div class="form-group">
                    <label for="error">Error</label>
                    <input type="checkbox" id="error" name="error" value="1" {{ old('error') ? 'checked' : '' }}>
                </div>
                    <div class="form-group">
                    <label for="warning">Warning</label>
                    <input type="checkbox" id="warning" name="warning" value="1" {{ old('warning') ? 'checked' : '' }}>
                </div>
                <div class="form-group">
                    <label for="successful">Successful</label>
                    <input type="checkbox" id="successful" name="successful" value="1" {{ old('successful') ? 'checked' : '' }}>
                </div>
                
            
                <div class="col align-items-end d-flex flex-column mb-3">
                    <div class="d-flex flex-column ">
                        <label for="filter" class="form-label">Filter</label>
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Client name..." value="{{ $filter ?? '' }}">
                        <span id="passwordHelpInline" class="form-text">
                                Type the whole or part of the name and press enter.
                        </span>
                        
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Filtrar</button>
            </form>
        </div>
        
        <div class="col-md-12 table-responsive"> 
            <table class="table align-middle">
                <thead>
                    <tr class="table-dark">
                        <!-- <th class="col-1">ID</th> -->
                        <th class="p-3" >@sortablelink('updated_at')</th>
                        <th class="p-3" >@sortablelink('hostname', 'Hostname')</th>
                        <th class="p-3">@sortablelink('successful','Count successful')</th>
                        <th class="p-3">@sortablelink('warning','Count warning')</th>
                        <th class="p-3">@sortablelink('error','Count errors')</th>
                        <th class="p-3">Report</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td class="p-3">{{$event->updated_at}}</td>
                        <td class="p-3"><a href="{{ route('clients.show',$event->report->client->id) }}"> {{$event->report->client->name}} </a></td>
                        <td class="p-3">
                            {{ $event->successful }} 
                        </td>
                        <td class="p-3">
                            {{ $event->warning }}
                        </td>
                        <td class="p-3">
                            {{ $event->error }}
                        </td>
                        <td class="p-3">
                            <a href="{{ route('clients.show_report',$event->report->client) }}"> View report</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $events->appends(\Request::except('page'))->render() !!}
    </div>
</div>
@endsection    