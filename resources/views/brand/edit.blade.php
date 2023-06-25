@extends('index')
    @section('content')

    <div class="col-md-8">
        <form action="{{ URL('brands/update/'.$id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold" for="brand_name">Brand Name :</label>
                            <input type="text" class="form-control brand_name" value="{{ $brand_data->brand_name }}" name="brand_name" id="brand_name" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="packsize">Description (Optional) :</label>
                            <input type="text" class="form-control packsize" value="{{ $brand_data->description }}" name="description" id="description">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="status">Status :</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" {{$brand_data->status == 1 ? 'selected' : ''}}>Active</option>
                                <option value="0" {{$brand_data->status == 0 ? 'selected' : ''}}>De-Active</option>
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
