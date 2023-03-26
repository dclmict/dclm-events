@extends('admin.layouts.ui')

@section('content')
    <div class="row">
        <div class="col-lg-7 col-md-7 mx-auto margin-tb">
            <div class="float-start">
                <h2>Edit Country</h2>
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

    <form action="{{ route('countries.update', $country->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 mx-auto">
                <div class="form-group">
                    <strong>Continent: {{ $country->continent->name }}</strong>
                    <select name="continent_id" class="form-select">
                        <option value="{{ $country->continent_id }}">Select Continent</option>
                        @foreach ($continents as $continent)
                            <option value="{{ $continent->id }}">{{ $continent->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 mx-auto">
                <div class="form-group">
                    <strong>Country Name:</strong>
                    <input type="text" name="name" value="{{ $country->name }}" class="form-control"
                        placeholder="Enter Country Name">
                </div>
            </div>
            <div class="col-xs-12 my-2 col-sm-12 col-md-7 mx-auto">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
@endsection
