@extends('layouts.app')
@section('content')
<div class="container py-5">
<div class="row">
    <div class="col-md-12 py-3">
        <h1>Hardware List</h1>
    </div>
    <div class="col-md-12">
        <form method="GET">
        <div class="col align-items-end d-flex flex-column mb-3">
            <div class="d-flex flex-column ">
                <label for="filter" class="form-label">Filter</label>
                <input type="text" class="form-control" id="filter" name="filter" placeholder="Mastherboard name..." value="{{ $filter ?? '' }}">
                <span id="passwordHelpInline" class="form-text">
                        Type the whole or part of the name and press enter.
                </span>
                
            </div>
        </div>
            <!-- <button type="submit" class="btn btn-default mb-2">Filter</button> -->
        </form>
    </div>

    <div class="col-md-12">
        <p>Example Hardware list  (static view)</p>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="">Motherboard Model 1</a>
                <span class="badge bg-primary rounded-pill">14 pc's</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="">Motherboard Model 2</a>
                <span class="badge bg-primary rounded-pill">34 pc's</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="">Motherboard Model 3</a>
                <span class="badge bg-primary rounded-pill">23 pc's</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="">.......</a>
                <span class="badge bg-primary rounded-pill">......</span>
            <li>
        </ul>
    </div>
</div>
</div>
@endsection