@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-7 col-md-7 mx-auto margin-tb">
            <div class="float-start">
                <h2>Add New Country</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-sm btn-primary" href="{{ route('countries.index') }}"> Back</a>
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

    <form action="{{ route('countries.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 mx-auto">
                <div class="form-group">
                    <strong>Continent:</strong>
                    <select name="continent_id" class="form-select">
                        <option value="">Select Continent</option>
                        @foreach ($continents as $continent)
                            <option value="{{ $continent->id }}">{{ $continent->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 mx-auto">
                <div class="form-group">
                    <strong>Country Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Enter Country Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 mx-auto my-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
