@extends('admin.layouts.admin')

@section('content')
    <div class="row">
        <div class="col-12  mx-auto margin-tb">
            <div class="float-start">
                <h2>Edit Program</h2>
            </div>
            <div class="float-end">
                <a class="btn btn-sm btn-primary" href="{{ route('programs.index') }}"> Back</a>
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

    {{-- @dump($program) --}}
    <form enctype="multipart/form-data" action="{{ route('programs.update',$program->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.programs.form-fields')
    </form>
@endsection

@section('footer_script')
<script id="eventForm">
    $('document').ready(function(){
        // Counter to keep track of the number of field groups added
        let fieldGroupCounter = 1;
        // Function to add a new field group
        function addNewFieldGroup() {
            fieldGroupCounter++;
            const newRow = $('<tr></tr>');
            newRow.append($('<td><input type="time" class="form-control form-control-sm" name="time[]" placeholder="Time" required></td>'));
            newRow.append($('<td><input type="text" class="form-control form-control-sm" name="event[]" placeholder="Event" required></td>'));
            newRow.append($('<td><input type="text" class="form-control form-control-sm" name="speaker[]" placeholder="Speaker"></td>'));
            newRow.append($('<td><button type="button" class="btn btn-danger btn-sm remove">X</button></td>'));
            $('#fieldTable').append(newRow);
        }
        // Event listener for the "Add Field Group" button
        $('#addField').click(addNewFieldGroup);
        // Event listener for removing a field group
        $('#fieldTable').on('click', '.remove', function() {
            $(this).closest('tr').remove();
        });
    //  edn of ready()
    });

</script>
@endsection

