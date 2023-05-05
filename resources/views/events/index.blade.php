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
                <div class="row col-sm-12 py-3 row-cols-lg-auto row-cols-sm-auto">
                    
                    <div class="col" style="height: min-content;align-self: center;">
                        <input type="checkbox" class="form-check-input" id="error" name="error" value="1" {{ old('error') ? 'checked' : '' }}>
                        <label for="error" class="">Error</label>
                    </div>
                    <div class="col" style="height: min-content;align-self: center;">
                        <input type="checkbox" class="form-check-input" id="warning" name="warning" value="1" {{ old('warning') ? 'checked' : '' }}>
                        <label for="warning" class="">Warning</label>
                    </div>
                    <div class="col" style="height: min-content;align-self: center;">
                        <input type="checkbox" class="form-check-input" id="successful" name="successful" value="1" {{ old('successful') ? 'checked' : '' }}>
                        <label for="successful" class="">Successful</label>
                    </div>
                    
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="filter" name="filter" placeholder="Client name..." value="{{ $filter ?? '' }}">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-md-12 table-responsive"> 
            <table class="table align-middle">
                <thead>
                    <tr class="table-dark">
                        <!-- <th class="col-1">ID</th> -->
                        <th class="p-3" >@sortablelink('updated_at')</th>
                        <th class="p-3" >@sortablelink('client_name', 'Hostname')</th>
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