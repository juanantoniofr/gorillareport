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
                        <h2 class="card-title"><i class="fa-solid fa-calendar"></i> Last events </h2>
                    </div>

                    <div class="card-body">
                        <p class="card-text">
                            <ul class="list-group list-group-flush">
                                <!-- Hash errors -->
                                @if (isset($hash_errors))
                                @foreach($hash_errors as $client_id => $hash_error)
                                    <a href="{{ route('clients.show_report', $client_id) }}" class="text-decoration-none">
                                        <li class="list-group-item">
                                            <span class="text-danger">
                                                <i class="fa-solid fa-danger"></i> {{ $hash_error }}: 
                                            </span>
                                        </li>
                                    </a>
                                    
                                @endforeach
                                @endif
                            

                                <!-- Events -->
                                
                                @foreach($last_events as $event )
                                    @foreach($event['managed_install_failed'] as $client_id => $install_failed)
                                        @foreach($install_failed as $task_name => $task_failed)
                                            @foreach($task_failed as $client_name => $error_message)
                                            <a href="{{ route('clients.show_report', $client_id) }}" class="text-decoration-none">
                                                <li class="list-group-item">
                                                    <span class="text-danger">
                                                        <i class="fa-solid fa-danger"></i> <b>{{ $client_name }}</b>: {{ $error_message }} 
                                                    </span>
                                                </li>
                                            </a>
                                            @endforeach
                                            
                                        @endforeach
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

 