@extends('layouts.app')

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1>Report Client: {{ $client->name }}</h1></div>
                
                <div class="card-body">
                    <a href="{{ url('/clients/' . $client->id) }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    
                    <h3 class="card-title">Basic Information</h3>
                    <p class="card-text">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Client Name:</b> {{ $client->name }}</li>
                            <li class="list-group-item"><b>Client IP:</b> {{ $client->ip }}</li>
                            <li class="list-group-item"><b>Client HUID:</b> {{ $client->huid }}</li>
                            <li class="list-group-item"><b>Client Last Report startTime:</b> {{ $report->lastExecution->startTime ?? '' }}</li>
                            <li class="list-group-item"><b>Client Last Report endTime:</b> {{ $report->lastExecution->endTime ?? ''}}</li>
                            <li class="list-group-item"><b>Client Last Report duration:</b> {{ $report->lastExecution->duration ?? ''}}</li>
                            <li class="list-group-item"><b>Client catalog:</b> {{ $report->lastExecution->catalog ?? ''}}</li>
                            <li class="list-group-item"><b>Client manifest:</b> {{ $report->lastExecution->manifest ?? ''}}</li>
                            <li class="list-group-item"><b>Client log path:</b> {{ $report->lastExecution->log ?? ''}}</li>
                        </ul>
                    </p>        
                </div>
                
                <div class="card-body">
                    <h3 class="card-title">Managed Install</h3>
                    <p class="card-text">
                    @if(isset($last_report))
                        @foreach($last_report as $key => $value)
                            <span><b>{{$key}}:</b> {{ $value }}</span>
                            <br />
                        @endforeach

                        
                    @else
                        <p>No Managed Install</p>
                    @endif
                    </p>
                    
                </div>
            </div>
        </div>
    </div>

@endsection