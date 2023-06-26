@extends('index')
    @section('content')
    <div class="row">
        <div class="col col-md-12 table-responsive">
            <a href="{{ route('brand.create') }}" class="btn btn-info mb-2">Create Brand</a>
            <a href="{{ route('brand') }}" class="btn btn-info mb-2">Brand List</a>

            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Brand Name</th>
                            <th style="width: 10%;">Description</th>
                            <th style="width: 15%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$brand_data->brand_name}}</td>
                            <td>{{$brand_data->description}}</td>
                            <td>{{$brand_data->status==1 ? 'Active': 'InActive'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
