@extends('index')
    @section('content')
    <div class="row">
        <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 5%;">SL.</th>
                            <th style="width: 15%;">Brand Name</th>
                            <th style="width: 20%;">Description</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($brand_data as $key=>$brand)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>{{ $brand->brand_name}}</td>
                                <td>{{ $brand->description}}</td>
                                <td>{{ $brand->status==1 ? "Active" : "In-Active"}}</td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ URL::to('brands/'.$brand->id.'/edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm" href="{{ URL::to('brands/'.$brand->id ) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <form action="{{ URL::to('brands/delete'.$brand->id ) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" style="display: inline-block;" onclick="return confirm('Are you sure to delete?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $brand_data->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>
@stop
<script>
    $(document).ready(function(){
        $(".delete_brand").click(function(){
            alert("The paragraph was clicked.");
        });
    });
</script>
