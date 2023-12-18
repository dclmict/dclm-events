@extends('admin.layouts.admin')
@section('body')
<table id="dataTableExample1" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>Country</th>
            <th>State</th>
            <th>Region</th>
            <th>Group</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="geography_tbody">
        <tr>
            <td>
                <input class="form-control" placeholder="Enter country name" id="country" type="text">
            </td>
            <td colspan="4">
                <button onclick="AddCountryToDB()" class="btn btn-success text-light btn-sm">
                    <i class="fa fa-pencil"></i>
                    Add
                </button>
            </td>
        </tr>
    </tbody>
    <caption id="caption_action_btn">
        <button onclick="AddCountry()" class="btn btn-sm btn-dark">Add Country</button>
        <button onclick="AddState()" class="btn btn-sm btn-outline-dark">Add State</button>
        <button onclick="AddRegion()" class="btn btn-sm btn-success">Add Region</button>
        <button onclick="AddGroup()" class="btn btn-sm btn-outline-success">Add Group</button>
    </caption>
</table>
@endsection
