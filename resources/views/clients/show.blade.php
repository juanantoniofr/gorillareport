@extends('layouts.app')

@section('content')

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1>Client {{ $client->name }}</h1></div>
                    <div class="card-body">
                    @if(url()->previous() && !Str::contains(url()->previous(), 'clients/report'))
                        <a href="{{ url()->previous() }}" title="Back"><button class="btn btn-warning btn-lg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    @else
                        <a href="{{ url('/clients') }}" title="Back"><button class="btn btn-warning btn-lg"><i class="fa fa-arrow-left" aria-hidden="true"></i> Clients</button></a>
                    @endif

                    
                        <a href="{{ url('/clients/report/' . $client->id) }}" title="View Report"><button class="btn btn-info btn-lg"><i class="fa fa-eye" aria-hidden="true"></i> View Report</button></a>
                        <!--
                        <a href="{{ url('/clients/' . $client->id . '/edit') }}" title="Edit Client"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        -->
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['clients', $client->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-lg',
                                    'title' => 'Delete Client',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table caption-top">
                                <caption><h3>Basic Computer information.</h3></caption>
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $client->id }}</td>
                                    </tr>
                                    <tr>
                                        <th> Huid </th><td> {{ $client->huid }} </td>
                                    </tr>
                                    <tr>
                                        <th> Name </th><td> {{ $client->name }} </td>
                                    </tr>
                                    <tr>
                                        <th> Ip </th>
                                        <td>{{ $client->ip }} </td>
                                    </tr>
                                    <tr>
                                        <th> Information </th>
                                        <td> 
                                            @if (isset($client->information))
                                                @foreach(json_decode($client->information, true) as $key => $value)
                                                    <span><b>{{$key}}:</b></span><br />
                                                    @foreach($value as $key2 => $value2)
                                                        <span><i>{{$key2}}: {{$value2}}</i></span>
                                                    @endforeach 
                                                    <br />                         
                                                @endforeach
                                            @else
                                                <span>No information available.</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table caption-top">
                                <caption><h3>Basic information about the Gorilla client.</h3></caption>
                                <tbody>
                                    <tr>
                                        <th> Catalog </th>
                                        <td>
                                            @if (isset($client->gorilla_global_info))
                                                {{ implode(",", json_decode($client->gorilla_global_info)->Catalog) }}
                                            @else
                                                <span class="badge bg-danger">No information available.</span>
                                            @endif
                                        </td>
                                    <tr>
                                    <tr>
                                        <th> Manifest </th>
                                        <td>
                                            @if (isset($client->gorilla_global_info))
                                                {{ json_decode($client->gorilla_global_info)->Manifest }}
                                            @else
                                                <span class="badge bg-danger">No information available.</span>
                                            @endif
                                        </td>

                                    </tr>
                                    <tr>    
                                        <th> Last Execution StartTime </th>
                                        <td>
                                            @if (isset($client->gorilla_global_info))
                                                {{ date("d-m-Y H:i:s", strtotime(json_decode($client->gorilla_global_info)->LastExecution_StartTime)) }}
                                            @else
                                                <span class="badge bg-danger">No information available.</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Last Execution EndTime </th>
                                        <td>
                                            @if (isset($client->gorilla_global_info))
                                                {{ date("d-m-Y H:i:s", strtotime(json_decode($client->gorilla_global_info)->LastExecution_EndTime)) }}
                                            @else
                                                <span class="badge bg-danger">No information available.</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th> Updated At </th><td> {{ $client->updated_at }} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
 
@endsection