@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-10 col-md-10 mx-auto margin-tb">
            <div class="float-start">
                <h2>Program Lists</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-sm btn-success" href="{{ route('programs.create') }}"> Create New program</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="col-lg-10 col-md-10 mx-auto">
            <div class="alert alert-dismissible alert-success">
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="col-lg-10 col-md-10 mx-auto">
            <div class="alert alert-dismissible alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <p>{{ $message }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <div class="col-lg-10 col-md-10 table-responsive mx-auto">
        <table class="my-3 table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Date</th>
                <th>Status</th>
                <th width="360px">Action</th>
            </tr>
            @foreach ($programs as $program)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ strip_tags($program->name) }}</td>
                    <td>{{ strip_tags($program->event_date) }}</td>
                    <td>
                        @if ($program->is_active)
                            <span class="text-success fw-bold">Open</span>
                        @else
                            <span class="text-danger fw-bold">Closed</span>
                        @endif
                        @if ($program->is_featured)
                            <span class="text-primary fw-bold"> | Featured</span>
                        @endif
                    </td>
                    <td>
                        {{-- <form action="{{ route('programs.destroy', $program->id) }}" method="POST"> --}}
                        @if ($program->is_active)
                            <a class="btn btn-sm mb-1 btn-outline-dark" href="{{ route('home') }}#registration-form">View Form</a>
                        @endif
                        <a class="btn btn-sm mb-1 btn-dark" href="{{ route('programs.data', $program->id) . '/' . $program->slug }}">View Data</a>
                        <a class="btn btn-sm mb-1 btn-primary" href="{{ route('programs.edit', $program->id) }}">Edit</a>
                        <a class="btn btn-sm mb-1 btn-outline-danger" href="{{ route('programs.toggle', $program->id) }}">Toggle Status</a>
                        <a class="btn btn-sm mb-1 btn-outline-primary" href="{{ route('programs.featured', $program->id) }}">Toggle Featured</a>
                        {{-- </form> --}}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    {!! $programs->links() !!}

@endsection
