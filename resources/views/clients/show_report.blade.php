@extends('layouts.app')

@section('content')

    <div class="container py-5">
        <h2>Report</h2>
        <p>Catálogo: {{ $report->lastExecution->catalog }}</p>
        <p>Manifest: {{ $report->lastExecution->manifest }}</p>
        <p>Start Time: {{ $report->lastExecution->startTime }}</p>
        <p>End Time: {{ $report->lastExecution->endTime }}</p>
        <p>Duration: {{ $report->lastExecution->duration }}</p>
        <p>Log: {{ $report->lastExecution->log }}</p>
        <h3>Managed Install</h3>
        @foreach ($report->lastExecution->managed_install as $item)
            <p>display_name: {{ $item->item }}</p>
            <p>Installing result: {{ $item->Installing->result }}</p>            
            <!-- <p> {{ var_dump($item->Checking)}} </p> 
            <p> {{ var_dump($item->Installing)}} </p> -->            
        @endforeach
    </div>

@endsection