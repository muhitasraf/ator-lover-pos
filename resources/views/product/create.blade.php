@extends('index')
@section('content')
    <div class="col-md-8">
        <form action="{{URL('product/store')}}" method="post">
            @csrf
            <div class="form-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold" for="product_name">Product Name :</label>
                            <input type="text" class="form-control product_name" placeholder="Product Name" name="product_name" id="product_name" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="capacity">Capacity :</label>
                            <input type="text" class="form-control capacity" placeholder="Capacity" name="capacity" id="capacity">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="packsize">Details (Optional) :</label>
                            <input type="text" class="form-control details" placeholder="Details" name="details" id="details">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold" for="brand_name">Brand Name :</label>
                            <select class="form-control" name="brand_name" id="brand_name">
                                <option value="" disable>Select Brand</option>
                                @foreach ($brand_data as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="type">Type :</label>
                            <select class="form-control" name="type" id="type">
                                <option value="" disable>Select type</option>
                                @foreach ($type_data as $type)
                                    <option value="{{ $type->id }}">{{ $type->type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="status">Status :</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1">Active</option>
                                <option value="0">De-Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 text-right">
                        <button type="submit" class="btn btn-info btnSubmit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

@stop
