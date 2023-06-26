@extends('index')
    @section('content')
    <div class="row">
        <div class="col col-md-12 table-responsive">
            <a href="{{ route('product.create') }}" class="btn btn-info mb-2">Create Product</a>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 5%;">SL.</th>
                            <th style="width: 15%;">Product Name</th>
                            <th style="width: 15%;">Brand Name</th>
                            <th style="width: 20%;">Capacity</th>
                            <th style="width: 20%;">Type</th>
                            <th style="width: 20%;">Details</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($product_data as $key=>$product)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>{{ $product->product_name}}</td>
                                <td>{{ $product->brand->brand_name}}</td>
                                <td>{{ $product->capacity}}</td>
                                <td>{{ $product->type->type_name}}</td>
                                <td>{{ $product->details}}</td>
                                <td>{{ $product->status==1 ? "Active" : "In-Active"}}</td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ URL::to('product/'.$product->id.'/edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm" href="{{ URL::to('product/'.$product->id ) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <form action="{{ URL::to('product/delete'.$product->id ) }}" method="post">
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
                    {!! $product_data->links('pagination::bootstrap-4') !!}
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
