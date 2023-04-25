@extends('layouts.app')

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1>Report Client: {{ $client->name }}</h1></div>
                
                <div class="card-body">
                    
                    <a href="{{ url('/clients/' . $client->id) }}" title="Back"><button class="btn btn-warning btn-lg my-4"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    
                    <h3 class="card-title">Basic Information</h3>
                    <p class="card-text">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><b>Client Name:</b> {{ $client->name }}</li>
                            <li class="list-group-item"><b>Client IP:</b> {{ $client->ip }}</li>
                            <li class="list-group-item"><b>Client HUID:</b> {{ $client->huid }}</li>
                            <li class="list-group-item"><b>Client catalog:</b> 
                                @if (isset(json_decode($client->gorilla_global_info)->Catalog))
                                    {{ implode(",", json_decode($client->gorilla_global_info)->Catalog) }}
                                @else
                                    <span class="badge bg-danger">No information available</span>
                                @endif
                            </li>
                            <li class="list-group-item"><b>Client manifest:</b>
                                @if (isset(json_decode($client->gorilla_global_info)->Manifest))
                                    {{ implode(",", json_decode($client->gorilla_global_info)->Manifest) }}
                                @else
                                    <span class="badge bg-danger">No information available</span>
                                @endif
                            </li> 
                            <li class="list-group-item"><b>Client Last Report startTime:</b> 
                                @if (isset(json_decode($client->gorilla_global_info)->LastExecution_StartTime))
                                    {{ date("d-m-Y H:i:s", strtotime(json_decode($client->gorilla_global_info)->LastExecution_StartTime)) }}
                                @else
                                    <span class="badge bg-danger">No information available</span>
                                @endif
                            </li>
                            <li class="list-group-item"><b>Client Last Report endTime:</b> 
                                @if (isset(json_decode($client->gorilla_global_info)->LastExecution_EndTime))
                                    {{ date("d-m-Y H:i:s", strtotime(json_decode($client->gorilla_global_info)->LastExecution_EndTime)) }}
                                @else
                                    <span class="badge bg-danger">No information available</span>
                                @endif
                            </li>
                        </ul>
                    </p>        
                </div>
                
                <div class="card-body">
                    <h3 class="card-title">Managed Install</h3>
                
                    
                        @if( isset($client->report->managed_install) )
                            <div class="accordion" id="managed_installs_acordeon">
                            @foreach(json_decode($client->report->managed_install) as $key => $managed_install)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading_{{$key}}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$key}}" aria-expanded="true" aria-controls="collapse_{{$key}}">
                                            @if (in_array(true, array_map(function($str) {
                                                        return strpos($str, "FAILED") !== false;
                                                        }, $managed_install->installing_ps1_block->command_output)))
                                                <span class="text-danger"><b>Task name:</b> {{ $managed_install->task_name }} 
                                            @else
                                                <span class="text-success"><b>Task name:</b> {{ $managed_install->task_name }}
                                            @endif
                                        </span>                                            
                                        </button>
                                    </h2>

                                    <div id="collapse_{{$key}}" class="accordion-collapse collapse" aria-labelledby="heading_{{$key}}" data-bs-parent="#managed_installs_acordeon">
                                        <div class="accordion-body">
                                            @if ( $managed_install->installing_ps1_block->hash_error ) 
                                                <b>HASH error:</b> <span class="text-danger">{{ var_dump($managed_install->installing_ps1_block->hash_error)}}</span>
                                            @else 
                                                <b>HASH:</b> <span class="text-success">correct!!</span>
                                            @endif
                                            <br />
                                            @if ( $managed_install->installing_ps1_block->download_error ) 
                                                <b>Download error:</b> <span class="text-danger">{{ var_dump($managed_install->installing_ps1_block->download_error)}}</span>
                                            @else 
                                                <b>Download:</b> <span class="text-success">correct!!</span>
                                            @endif
                                            <br />

                                            <!-- check_block -->
                                            @if ( $managed_install->check_block ) 
                                                <b>Check block:</b> 
                                                <p class="ms-4">
                                                    <b>Vía:</b> {{ $managed_install->check_block->via }}
                                                </p>
                                            @else
                                                <b>Check block:</b> Nothing in this Section.</span><br />
                                            @endif
                                            
                                            
                                            @if ( isset($managed_install->installing_ps1_block->command) && !empty($managed_install->installing_ps1_block->command) ) 
                                                <b>Command:</b> 
                                                    <p class="ms-4">
                                                        @foreach($managed_install->installing_ps1_block->command as $command)
                                                            <span>{{ $command }}</span><br />
                                                        @endforeach
                                                    </p>
                                            @else
                                                <b>Command:</b> Nothing in this Section.</span><br />
                                            @endif
                                            
                                            
                                            
                                            @if ( $managed_install->installing_ps1_block->command_output ) 
                                                <b>Command output:</b>    
                                                    <p class="ms-4">
                                                        @foreach($managed_install->installing_ps1_block->command_output as $command_output)
                                                            <span>{{ $command_output }}</span><br />
                                                        @endforeach
                                                    </p>
                                            @else 
                                                <b>Command output:</b> Nothing in this Section.</span>   
                                            @endif
                                        </div>
                                    </div>
                                        
                                        
                                        

                                            
                                        
                                </div>
                            @endforeach
                            </div>
                            
                            
                        @else
                            <p>No Managed Install</p>
                        @endif
                    

                    
                </div>
                                                        
                <div class="card-body">
                    <h3 class="card-title">Managed Uninstall</h3>
                    @if (isset($client->report->managed_uninstall) && !empty( json_decode($client->report->managed_uninstall,true)) )
                        {{ var_dump( json_decode($client->report->managed_uninstall) ) }}
                    @else
                        <p>Nothing in this Section.</p>
                    @endif
                </div>
                <div class="card-body">
                    <h3 class="card-title">Managed Update</h3>
                    @if( isset($client->report->managed_update) && !empty( json_decode($client->report->managed_update,true)) )
                        {{ var_dump($client->report->managed_update) }}
                    @else
                        <p>Nothing in this Section.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>

@endsection