@extends('layouts.app')
@section('content')
<div class="container py-5">
<div class="row">
    <div class="col-md-12 py-3">
        <h1>Software List</h1>
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
        <p>Example Software list  (static view)</p>
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="">Blender</a>
                <span class="badge bg-primary rounded-pill">14 Instalations</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="">Gimp</a>
                <span class="badge bg-primary rounded-pill">12 Instalations</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="">Davinci</a>
                <span class="badge bg-primary rounded-pill">34 Instalations</span>
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