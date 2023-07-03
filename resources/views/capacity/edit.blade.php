@extends('index')
    @section('content')
    <div class="col-md-8">
        <form action="{{ route('capacity.update', $capacity_name->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="form-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold" for="capacity_name">Medicine Type Name :</label>
                            <input type="text" class="form-control form-control-sm capacity_name" value="{{ $capacity_name->capacity_name ?? ''}}" name="capacity_name" id="capacity_name" required/>
                            <input type="hidden" value="{{ $capacity_name->id ?? ''}}" name="capacity_id" id="capacity_id">
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold" for="status">Status :</label>
                            <select class="form-control" name="status" id="status">
                                <option value="1" {{ $capacity_name->status==1 ? "selected": "" }}>Active</option>
                                <option value="0" {{ $capacity_name->status==0 ? "selected": "" }}>De-Active</option>
                            </select>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-info btnSubmit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
