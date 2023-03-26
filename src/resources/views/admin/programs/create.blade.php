@extends('admin.layouts.ui')

@section('content')
<div class="row">
    <div class="col-lg-7 col-md-7 mx-auto margin-tb">
        <div class="float-start">
            <h2>Add New Program</h2>
        </div>
        <div class="float-end">
            <a class="btn btn-sm  btn-primary" href="{{ route('programs.index') }}"> Back</a>
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

<form enctype="multipart/form-data" action="{{ route('programs.store') }}" method="POST">
    @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-7 mx-auto">
            <div class="form-group">
                <strong>Event Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="The Power that Never Fails">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 mx-auto">
            <div class="form-group">
                <strong>Event Type:</strong>
                <input type="text" name="category" class="form-control" placeholder="GCK: November Edition">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 mx-auto">
            <div class="form-group">
                <strong>Event Date:</strong>
                <input type="text" name="date" class="form-control" placeholder="November 17 - 20th, 2022">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 mx-auto">
            <div class="form-group">
                <strong>Event Countdown:</strong>
                <input type="text" name="countdown" class="form-control" placeholder="2022/11/17">
            </div>
        </div>  
        <div class="col-xs-12 col-sm-12 col-md-7 mx-auto">
            <div class="form-group">
                <strong>Banner Image:</strong>
                <input type="file" name="image" name="id" accept="image/jpeg, image/png, image/jpg, image/gif, image/svg" class="form-control" placeholder="Event FLyer 1920px x 1080px">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-7 mx-auto my-2">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>
@endsection
