@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row">
    
        <h1>Dashboard</h1>

        <div class="card-deck col-lg-3">
    
            <!-- Activity -->
            <div class="card mb-2">
                <a href="{{ route('clients') }}" class="text-decoration-none">
                    <div class="card-header p-3 text-white bg-dark">
                        <h2 class="card-title"><i class="fa-solid fa-computer"></i> Activity </h2>
                    </div>
                </a>

                <div class="card-body">
                    <p class="card-text">{{ $numClients }} Registrados, <b>{{ $activeClients }} activos </b></p>
                    <a href="{{ route('clients') }}" class="btn btn-primary">Pc-Clients >></a>
                </div>
            </div>

            
        </div>

        <div class="card-deck col-lg-9">
            <!-- Last 10 events -->
            <div class="card">
                <a href="#" class="text-decoration-none">
                    <div class="card-header p-3 text-white bg-dark">
                        <h2 class="card-title"><i class="fa-solid fa-calendar"></i> Last events </h2>
                    </div>

                    <div class="card-body">
                        <p class="card-text">
                            <ul class="list-group list-group-flush">
                                @foreach($events as $event )
                                    <a href="{{ route('clients.show_report', $event->report->client) }}" class="text-decoration-none">
                                        @if ($event->error > 0)
                                            <li class="list-group-item">
                                                <span class="text-danger">
                                                    <i class="fa-solid fa-danger"></i> {{ $event->report->client->name }} ({{ $event->report->client->ip }}):  {{ $event->error }} Errors installations  at {{ $event->updated_at }} 
                                                </span>
                                            </li>
                                        @endif

                                        <li class="list-group-item">
                                            <span class="text-success">
                                                <i class="fa-solid fa-check"></i> {{ $event->report->client->name }} ({{ $event->report->client->ip }}):  {{ $event->successful }} Successful installations  at {{ $event->updated_at }}
                                            </span>
                                        </li>
                                    </a>
                                @endforeach   
                            </ul>   
                        </p>
                    </div>
                </a>
            </div><!-- card last 10 events -->

        </div><!-- card-deck -->

    </div><!-- row -->    
</div><!-- container -->
@endsection
