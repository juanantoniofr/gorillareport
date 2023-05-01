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
            <!-- Errors and successful -->
            <div class="card">
                <a href="#" class="text-decoration-none">
                    <div class="card-header p-3 text-white bg-dark">
                        <h2 class="card-title"><i class="fa-solid fa-calendar"></i> Last Gorilla Events </h2>
                    </div>

                    <div class="card-body">
                        <p class="card-text">
                            
                            <ul class="list-group list-group-flush">
                            <!-- Events -->
                            
                                @foreach($last_events as $events )
                                    @foreach($events as $cheking_item => $cheking_result)
                                        @if ($cheking_item == "managed_install_successful")
                                            <a href="{{ route('clients.show_report', $client_id) }}" class="text-decoration-none">
                                                <li class="list-group-item">
                                                    <span class="text-success">
                                                        <i class="fa-solid fa-success"></i> {{ $cheking_result }} 
                                                    </span>
                                                </li>
                                            </a>
                                        @else
                                            @foreach($cheking_result as $client_id => $tasks_result)
                                                @foreach($tasks_result as $task_name => $results)
                                                    @foreach($results as $message)
                                                    <a href="{{ route('clients.show_report', $client_id) }}" class="text-decoration-none">
                                                        <li class="list-group-item">
                                                            <span class="text-danger">
                                                                <i class="fa-solid fa-danger"></i> {{ $message }} 
                                                            </span>
                                                        </li>
                                                    </a>
                                                    @endforeach
                                                @endforeach 
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endforeach   
                            </ul>
                               
                        </p>
                        {{ $last_events->withPath('home')->links() }}
                    </div>
                </a>
            </div><!-- card last 10 events -->

        </div><!-- card-deck -->

       

    </div><!-- row -->    
</div><!-- container -->
@endsection

 