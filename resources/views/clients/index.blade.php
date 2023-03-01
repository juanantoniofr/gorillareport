@extends('layouts.app')
@section('content')

<h2>Pc-Clients</h2>
<div class="row justify-content-md-center">

    
        <form class="form-inline" method="GET">
        <div class="form-group mb-2">
            <label for="filter" class="col-sm-2 col-form-label">Filter</label>
            <input type="text" class="form-control" id="filter" name="filter" placeholder="Client name..." value="{{ $filter ?? '' }}">
        </div>
        <button type="submit" class="btn btn-default mb-2">Filter</button>
        </form>
    

    <div class="row">    
  
        <table class="table table-bordered">
            <thead>
                <tr  class="">
                    <!-- <th class="col-1">ID</th> -->
                    <th class="col-2" >@sortablelink('updated_at')</th>
                    <th class="col-1" >@sortablelink('name')</th>
                    <th class="col-1">@sortablelink('ip')</th>
                    <th class="col-8">Information</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td >{{$client->updated_at}}</td>
                    <td >{{$client->name}}</td>
                    <td >{{$client->ip}}</td>
                    <td >
                        <?php 
                            $information = json_decode($client->information,true);
                        ?>
                        
                        
                        <p>
                            @foreach(json_decode($client->information,true) as $key=>$value)
                                    <span> <b>{{ $key }}:</b> {{ $value }} </span>
                            @endforeach
                        </p>
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- {!! $clients->links() !!} -->
        {!! $clients->appends(\Request::except('page'))->render() !!}
    </div>
<div>
@endsection