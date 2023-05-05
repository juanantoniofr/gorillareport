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

            <!-- Summary -->
            <div class="card mb-2">
                <a href="{{ route('clients') }}" class="text-decoration-none">
                    <div class="card-header p-3 text-white bg-dark">
                        <h2 class="card-title"><i class="fa-solid fa-list-check"></i> Summary </h2>
                    </div>
                </a>

                <div class="card-body">
                    <p class="card-text text-danger"> Clients with task Errors: {{ $errors ?? 0 }}</p>
                    <p class="card-text text-warning"> Clients with task Warnings: {{ $warnings ?? 0 }}</p>
                    <p class="card-text text-success"> Clients with task Successful: {{ $successfuls ?? 0 }}</p>
                </div>
            </div>
            
        </div>

        <div class="card-deck col-lg-9">
            <!-- Errors and successful -->
            <div class="card">
                <a href="#" class="text-decoration-none">
                    <div class="card-header p-3 text-white bg-dark">
                        <h2 class="card-title"><i class="fa-solid fa-calendar"></i> Last Gorilla Reports </h2>
                    </div>

                    <div class="card-body">
                        <p class="card-text">
                           
                            <ul class="list-group list-group-flush">
                            <!-- Reports -->
                                
                                @foreach($reports as $report )
                                    <a href="{{ route('clients.show_report', [ 'client' => $report['id'] ] )  }}" class="text-decoration-none">
                                        @if(strpos($report[0], 'successful') === false)
                                            <li class="list-group-item text-danger"> <i class="fa-solid fa-danger"></i> {{ $report[0] }}</li>
                                        @else
                                            <li class="list-group-item text-success"> <i class="fa-solid fa-success"></i> {{ $report[0] }}</li>
                                        @endif
                                            </li>
                                    </a>
                                @endforeach                        
                            </ul>
                        </p>
                        {{ $reports->withPath('home')->links() }}
                    </div>
                </a>
            </div><!-- card last 10 reports -->

        </div><!-- card-deck -->

       

    </div><!-- row -->    
</div><!-- container -->
@endsection

 