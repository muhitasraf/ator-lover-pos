@extends('dashboard.index')
    @section('content')
    <div class="row">
        <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 5%;">SL.</th>
                            <th style="width: 15%;">Brand Name</th>
                            <th style="width: 20%;">Generic Name</th>
                            <th style="width: 10%;">Type</th>
                            <th style="width: 10%;">Strength</th>
                            <th style="width: 10%;">Packing</th>
                            <!-- <th style="width: 20%;">Supplier</th> -->
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($medicine_list as $key=>$medicine)
                            <tr>
                                <td>{{ ++$key}}</td>
                                <td>{{ $medicine->brand_name}}</td>
                                <td>{{ $medicine->generic_name}}</td>
                                <td>{{ $medicine->type_name}}</td>
                                <td>{{ $medicine->strength}}</td>
                                <td>{{ $medicine->packsize}}</td>
                                {{-- <td>{{ $medicine->company_name}}</td> --}}
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ URL::to('brands/'.$medicine->id.'/edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm" href="{{ URL::to('brands/'.$medicine->id ) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <form action="{{ route('brands.destroy', $medicine->id ) }}" method="post">
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
                    {!! $medicine_list->links('pagination::bootstrap-4') !!}
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
