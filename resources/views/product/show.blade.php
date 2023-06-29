@extends('index')
    @section('content')
    <div class="row">
        <div class="col col-md-12">
            <a href="{{route('product.create')}}" class="btn btn-info">Create Product</a>
            <a href="{{route('product')}}" class="btn btn-info">All Product</a>
            <div class="table-responsive mt-2">
            	<table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Product Name</th>
                            <th style="width: 15%;">Brand Name</th>
                            <th style="width: 20%;">Capacity</th>
                            <th style="width: 20%;">Type</th>
                            <th style="width: 20%;">Details</th>
                            <th style="width: 10%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $product_data->product_name}}</td>
                            <td>{{ $product_data->brand->brand_name}}</td>
                            <td>{{ $product_data->capacity}}</td>
                            <td>{{ $product_data->type->type_name}}</td>
                            <td>{{ $product_data->details}}</td>
                            <td>{{ $product_data->status==1 ? "Active" : "In-Active"}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@stop
