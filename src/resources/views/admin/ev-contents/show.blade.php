@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-start">
                <h2> Show Country</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-sm btn-primary" href="{{ route('countries.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $country->name }}
            </div>
            <div class="form-group">
                <strong>Continent:</strong>
                {{ $country->continent->name }}
            </div>
        </div>
    </div>
@endsection
