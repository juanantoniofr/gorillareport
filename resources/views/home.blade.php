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
    
            <!-- Manifest status -->
            <div class="card">
            <a href="{{ route('clients') }}" class="text-decoration-none">
                <div class="card-header p-3 text-white bg-danger">
                    <h2 class="card-title"><i class="fa-solid fa-file"></i></i> Manifest status </h2>
                </div>
            </a>

            <div class="card-body">
                <p class="card-text">
                  Equipos con manifest igual a <b>default_manifest</b>
                </p>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($clientsWithDefaultManifest as $clientWithDefaultManifest)
                    <li class="list-group-item">
                    <i class="fa-solid fa-angles-right"></i> {{ $clientWithDefaultManifest->name }} ( {{ $clientWithDefaultManifest->ip }})
                    </li>
                @endforeach
            </ul>
            </div>
        </div>

        <div class="card-deck col-lg-6">

            <!-- UpTime Status -->
            <div class="card mb-2">
                <a href="" class="text-decoration-none">
                    <div class="card-header p-3 text-white bg-dark">
                        <h2 class="card-title"><i class="fa-solid fa-power-off"></i> UpTime </h2>
                    </div>
                </a>

                <div class="card-body">
                    <p class="card-text text-center">
                        
                        <a class="btn btn-danger disabled" href="">
				            <span class="bigger-150">{{ $UpTimeclients_7dm  ?? 0 }}</span><br>
				            7 <span data-i18n="date.day_plural">Days</span> +
			            </a>

                        <a class="btn btn-warning" href="">
				            <span class="bigger-150">{{ $UpTimeclients_7d  ?? 0 }}</span><br>
				            &lt; 7 <span data-i18n="date.day_plural">Days</span>
			            </a>

                        <a class="btn btn-success" href="">
                            <span class="bigger-150">{{ $UpTimeclients_1d }}</span><br>
                            &lt; 1 <span data-i18n="date.day">Day</span>
			            </a>
                    </p>
                </div>
                
            </div><!-- card UpTime Status -->

            <!-- Last 10 events -->
            <div class="card">
                <a href="" class="text-decoration-none">
                    <div class="card-header p-3 text-white bg-dark">
                        <h2 class="card-title"><i class="fa-solid fa-calendar"></i> Last 10 events </h2>
                    </div>

                    <div class="card-body">
                        <p class="card-text">
                            <ul class="list-group">
                                @foreach($reports as $key => $report )
                                    <li class="list-group-item">
                                        <i class="fa-solid fa-angles-right"></i> {{ var_dump($report->lastExecution) }}
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
