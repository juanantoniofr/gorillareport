    <div class="row">
        <div class="col-lg-11">
            <h2>Add New Pc Client</h2>
        </div>
        <div class="col-lg-1">
            <a class="btn btn-primary" href="{{ url('client') }}"> Back</a>
        </div>
    </div>
 
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('client.store') }}" method="POST">
        <!-- @csrf -->
        <div class="form-group">
            <label for="name">Pc Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Pc Name" name="name">
        </div>
        
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

    <form name="test" action="">
  <label for="GET-name">Nombre:</label>
  <input id="GET-name" type="text" name="name">
  <input type="submit" value="Save">
</form>
