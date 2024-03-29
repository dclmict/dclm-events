@extends('admin.layouts.admin')
@section('content')
    <div class="table-responsive">
        <table id="data-table-all" class="table">
            <!-- <div>
                <a class="btn btn-light mb-2 toggle-vis-all" data-table="data-table-all"
                    data-column="1">Toggle Program Visibility</a>
            </div> -->
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Program</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Phone N<sup><u>o</u></sup></th>
                    <th scope="col">Whatsapp N<sup><u>o</u></sup></th>
                    <th scope="col">Continent</th>
                    <th scope="col">Country</th>
                    <th scope="col">State</th>
                    <th scope="col">LGA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allData as $data)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{!! strip_tags($data->program->name) ?? 'NA' !!}</td>
                    <td>{{ $data->full_name  ?? 'NA' }}</td>
                    <td>{{ $data->email  ?? 'NA' }}</td>
                    <td>{{ $data->gender  ?? 'NA' }}</td>
                    <td>{{ $data->phone  ?? 'NA' }}</td>
                    <td>{{ $data->whatsapp  ?? 'NA' }}</td>
                    <td>{{ $data->country->continent->name  ?? 'NA' }}</td>
                    <td>{{ $data->country->name  ?? 'NA' }}</td>
                    <td>{{ $data->state ?? 'NA' }}</td>
                    <td>{{ $data->lga  ?? 'NA' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
