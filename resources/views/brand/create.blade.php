@extends('index')
@section('content')
    <div class="col-md-8">
        <form action="{{URL('brands/store')}}" method="post">
            @csrf
            <div class="form-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold" for="brand_name">Brand Name :</label>
                            <input type="text" class="form-control brand_name" placeholder="Brand Name" name="brand_name" id="brand_name" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="packsize">Description (Optional) :</label>
                            <input type="text" class="form-control packsize" placeholder="Description" name="description" id="description">
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
