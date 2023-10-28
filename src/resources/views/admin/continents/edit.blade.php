@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-7 col-md-7 mx-auto margin-tb">
            <div class="float-start">
                <h2>Edit Continent</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-sm btn-primary" href="{{ route('continents.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="col-lg-7 col-md-7 mx-auto">
            <div class="alert alert-dismissible alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <form action="{{ route('continents.update',$continent->id) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 mx-auto">
                <div class="form-group">
                    <strong>Continent Name:</strong>
                    <input type="text" name="name" value="{{ $continent->name }}" class="form-control" placeholder="Enter Continent Name">
                </div>
            </div>
            <div class="col-xs-12 my-2 col-sm-12 col-md-7 mx-auto">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
