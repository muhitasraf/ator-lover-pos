@extends('index')
    @section('content')
    <div class="row mb-3">
        <div class="col col-md-12">
            <input type="button" value="Add Row" id="add_row_btn" class="btn btn-sm btn-primary add_row_btn">
            <a class="btn btn-success btn-sm" href="{{ route('purchase')}}">
                Purrchase List
            </a>
        </div>
    </div>

    <!-- company details content -->
    <form action="{{ route('purchase.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <label for="basic-url" class="form-label">Your vanity URL</label>
                <div class="input-group">
                    <input type="text" name="invoice_no" value="{{ $new_invoice_no }}" class="form-control form-control-sm invoice_no">
                    <input type="date" name="tran_date" class="form-control form-control-sm mx-1 tran_date">
                </div>
                <table class="table table-bordered table-striped mt-2 row_add purchase_table">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Brand Name</th>
                            <th>Product Name</th>
                            <th>Capacity</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="append_row">
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger remove_row" value="delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                            <td>
                                <select class="form-control select2_1 select2 brand_name" style="width : 100%;" name="brand_name[]" id="brand_name">
                                    <option value="0">Select Brand</option>
                                    @foreach ($brand_data as $brand)
                                        <option value="{{ $brand->id }}">{{$brand->brand_name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2_1 select2 product_name" style="width : 100%;" name="product_name[]" id="product_name">
                                    <option value="0">Select Product</option>
                                </select>
                            </td>
                            <td><input type="text" name="capacity[]" class="form-control form-control-sm capacity"></td>
                            <td><input type="text" name="price[]" class="form-control form-control-sm price"></td>
                            <td><input type="text" name="qty[]" class="form-control form-control-sm qty" /></td>
                            <td><input type="text" name="total[]" class="form-control form-control-sm total" readonly/></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">Total</td>
                            <td><input type="text" name="total_qty" class="form-control form-control-sm total_qty" readonly/></td>
                            <td><input type="text" name="grand_total" class="form-control form-control-sm grand_total" readonly/></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- horizontal line -->
        <div class="row col-md-12">
            <hr class="col-md-12 float-left" style="padding: 0px; border-top: 2px solid  #02b6ff;">
        </div>
        <!-- form submit button -->
        <div class="row col-md-12">
            &emsp;
            <div class="form-group m-auto">
                <button class="btn btn-primary">Add Product</button>
            </div>
        </div>
    </form>

@stop
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $('.purchase_table').on('change', '.brand_name',function(){
            let this_key = $(this);
            let brand_id = this_key.val();
            $.ajax({
                url: '{{ URL::to("product_by_brand") }}',
                type: 'POST',
                data: {'brand_id':brand_id, '_token' : '{{csrf_token()}}'},
                success: function(result){
                    let option = '<option value="0">Select Product</option>';
                    if(result.length){
                        let product_data =  result;
                        for(let i=0; i<product_data.length; i++){
                            option += '<option value="'+ product_data[i].id +'">'+ product_data[i].product_name+'</option>';
                        }
                        this_key.closest('tr').find('td select.product_name').empty().append(option);
                    }else{
                        this_key.closest('tr').find('td select.product_name').empty().append(option);
                        toastr.success("Something went wrong!");
                    }
                }
            });
        });

        $('.purchase_table').on('change', '.product_name',function(){
            let this_key = $(this);
            let product_id = this_key.val();
            $.ajax({
                url: '{{ URL::to("product_details") }}',
                type: 'POST',
                data: {'product_id':product_id, '_token' : '{{csrf_token()}}'},
                success: function(result){
                    let product_details =  result;
                    this_key.closest('tr').find('td input.capacity').val(product_details.capacity);
                }
            });
        });

        $('.purchase_table').on('keyup', '.qty, .price',function(){
            let qty = $(this).closest('tr').find('td input.qty').val()??0;
            let price = $(this).closest('tr').find('td input.price').val()??0;
            $(this).closest('tr').find('td input.total').val(qty*price);
            calculate_total();
        });


    });
    $('table.purchase_table').on('click', '.remove_row', async function () {
        await remove_row($(this));
        calculate_total();
    });
    function calculate_total(){
        let total_qty = 0;
        $('.qty').each(function(){
            if($(this).val()){
                total_qty += parseFloat($(this).val());
            }
        });
        $('.total_qty').val(total_qty);

        let grand_total = 0;
        $('.total').each(function(){
            if($(this).val()){
                grand_total += parseFloat($(this).val());
            }
        });
        $('.grand_total').val(grand_total);
    }

</script>
@stop

