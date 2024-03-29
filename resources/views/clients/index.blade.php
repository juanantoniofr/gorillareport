@extends('layouts.app')
@section('content')
<div class="container py-5">
<div class="row">
    <div class="col-md-12 py-3">
        <h1>Client List</h1>
    </div>
    <div class="col-md-12">
        <form method="GET">
        <div class="col align-items-end d-flex flex-column mb-3">
            <div class="d-flex flex-column ">
                <label for="filter" class="form-label">Filter</label>
                <input type="text" class="form-control" id="filter" name="filter" placeholder="Client name..." value="{{ $filter ?? '' }}">
                <span id="passwordHelpInline" class="form-text">
                        Type the whole or part of the name and press enter.
                </span>
                
            </div>
        </div>
            <!-- <button type="submit" class="btn btn-default mb-2">Filter</button> -->
        </form>
    </div>
    
    <div class="col-md-12 table-responsive"> 
        <table class="table align-middle">
            <thead>
                <tr class="table-dark">
                    <!-- <th class="col-1">ID</th> -->
                    <th class="p-3" >@sortablelink('updated_at')</th>
                    <th class="p-3" >@sortablelink('name','Hostname')</th>
                    <th class="p-3">@sortablelink('ip')</th>
                    <th class="p-3">Information</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td class="p-3">{{$client->updated_at->format('d-m-Y H:i:s')}}</td>
                    <td class="p-3"><a href="{{ route('clients.show',$client->id) }}"> {{$client->name}} </a></td>
                    <td class="p-3">{{ $client->ip }}</td>
                    <td class="p-3">
                        @foreach(json_decode($client->information, true) as $key => $value)
                            <span><b>{{$key}}: </b></span><br />
                            @foreach($value as $key2 => $value2)
                                <span>{{$key2}}: {{$value2}}</span>
                            @endforeach
                            <br />                     
                        @endforeach 
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- {!! $clients->links() !!} -->
        

        {!! $clients->appends(\Request::except('page'))->render() !!}
    </div>
<div>
</div>
@endsection