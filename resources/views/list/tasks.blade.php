@extends('layouts.app')
@section('content')
<div class="container py-5">
<div class="row">
    <div class="col-md-12 py-3">
        <h1>Task's List</h1>
    </div>
    <div class="col-md-12">
        <form method="GET">
        <div class="col align-items-end d-flex flex-column mb-3">
            <div class="d-flex flex-column ">
                <label for="filter" class="form-label">Filter</label>
                <input type="text" class="form-control" id="filter" name="filter" placeholder="Software name..." value="{{ $filter ?? '' }}">
                <span id="passwordHelpInline" class="form-text">
                        Type the whole or part of the name and press enter.
                </span>
                
            </div>
        </div>
            <!-- <button type="submit" class="btn btn-default mb-2">Filter</button> -->
        </form>
    </div>
    
    <div class="col-md-12">
        <h4>Task's list  </h4>
        <ul class="list-group">
            @foreach ($list_tasks as $task)
                <li class="list-group-item d-flex justify-content-between">
                    <a href="">{{ $task->task_name }}</a>
                    <div class="align-items-right">
                        <span class="badge bg-success rounded-pill">Successfuls instalations: {{ $task->task_successful }}</span>
                        <span class="badge bg-danger rounded-pill">Faileds instalations: {{ $task->task_failed }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
</div>
@endsection