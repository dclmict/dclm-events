@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-7 col-md-7 mx-auto margin-tb">
            <div class="float-start">
                <h2>Country Lists</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-sm btn-success" href="{{ route('countries.create') }}"> Create New country</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="col-lg-7 col-md-7 mx-auto">
            <div class="alert alert-dismissible alert-success">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="col-lg-7 col-md-7 table-responsive mx-auto">
        <table class="my-3 table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Continent</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($countries as $country)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $country->name }}</td>
                    <td>{{ $country->continent->name }}</td>
                    <td>
                        {{-- <form action="{{ route('countries.destroy',$country->id) }}" method="POST"> --}}
                        {{-- <a class="btn btn-info" href="{{ route('countries.show', $country->id) }}">Show</a> --}}
                        <a class="btn btn-sm btn-primary" href="{{ route('countries.edit', $country->id) }}">Edit</a>
                        {{-- @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form> --}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    {!! $countries->links() !!}

@endsection
