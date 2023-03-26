@extends('admin.layouts.ui')
@section('body')
    {{-- <h3 class="mt-4">Country Setup</h3> --}}
    <div class="form-group my-2">
        <div class="row">
            <div class="col-md-11 col-lg-11 my-1">
                <input type="text" class="form-control form-control-sm" id="country" name="country"
                    placeholder="Enter Country Name" />
            </div>
            <div class="col-md-1 col-lg-1 my-1">
                <button class="btn w-100 btn-sm btn-primary">Add</button>
            </div>
        </div>
    </div>
    <hr>
    <table id="data-table-any" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Country</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="geography_tbody">
            @foreach ($countries as $country)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $country->country }}</td>
                    <td>
                        <a class="btn btn-sm btn-primary" href="{{ route('admin.states', $country->id) }}">View States</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
