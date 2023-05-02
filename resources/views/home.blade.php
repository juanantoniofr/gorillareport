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
                                
                                @foreach($last_events as $event )
                                    <a href="{{ route('clients.show_report', [ 'client' => $event['id'] ] )  }}" class="text-decoration-none">
                                        @if(strpos($event[0], 'successful') === false)
                                            <li class="list-group-item text-danger"> <i class="fa-solid fa-danger"></i> {{ $event[0] }}</li>
                                        @else
                                            <li class="list-group-item text-success"> <i class="fa-solid fa-success"></i> {{ $event[0] }}</li>
                                        @endif
                                            </li>
                                    </a>
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

 