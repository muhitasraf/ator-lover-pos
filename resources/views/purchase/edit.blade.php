@extends('index')
    @section('content')
    <div class="row">
        <div class="col col-md-12">
            <a class="btn btn-success btn-sm mb-3" href="{{ route('purchase')}}">
                Purrchase List
            </a>
        </div>
    </div>
    {{-- @dd($purchase_data[0]->tran_id); --}}
    <!-- company details content -->
    <form action="{{ route('purchase.update',$purchase_data[0]->tran_id)}}" method="post">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="font-weight-bold" for="invoice_no">Invoice No :</label>
                    <input type="text" class="form-control form-control-sm" name="invoice_no" value="{{ $purchase_data[0]->invoice_no ?? ''}}" id="invoice_no" readonly>
                    <input type="hidden" name="tran_id" value="{{$purchase_data[0]->tran_id}}">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="font-weight-bold" for="purchase_date">Purchase Date :</label>
                    <input type="date" class="form-control form-control-sm purchase_date" name="purchase_date" value="{{ $purchase_data[0]->tran_date }}" id="purchase_date">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="font-weight-bold" for="remarks">Remarks :</label>
                    <input type="text" class="form-control form-control-sm remarks" name="remarks" placeholder="Remarks" id="remarks">
                    <code class="text-danger small font-weight-bold float-right" id="name_error" style="display: none;"></code>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
            <input type="button" value="Add Row" id="add_row_btn" class="btn btn-primary add_row_btn" />
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
                    @foreach ($purchase_data as $purchase)
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger remove_row" value="delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                            <td>
                                <select class="form-control select2_1 select2 brand_name" style="width : 100%;" name="brand_name[]" id="brand_name">
                                    <option value="0">Select Brand</option>
                                    @php
                                        foreach($brand_data as $brand){
                                            $selected = '';
                                            if($purchase->brand_id == $brand->id){
                                                $selected = 'selected';
                                            }
                                            echo "<option value='$brand->id' $selected>$brand->brand_name</option>";
                                        }
                                    @endphp
                                </select>
                            </td>
                            <td>
                                <select class="form-control select2_1 select2 product_name" style="width : 100%;" name="product_name[]" id="product_name">
                                    <option value="0">Select Product</option>
                                    @php
                                        foreach($products as $product){
                                            $selected = '';
                                            if($purchase->product_id == $product->id){
                                                $selected = 'selected';
                                            }
                                            echo "<option value='$product->id' $selected>$product->product_name</option>";
                                        }
                                    @endphp
                                </select>
                            </td>
                            <td>
                                <input type="text" name="capacity[]" value="{{$purchase->capacity}}" class="form-control form-control-sm capacity">

                            </td>
                            <td><input type="text" name="price[]" value="{{$purchase->price}}" class="form-control form-control-sm price"></td>
                            <td><input type="text" name="qty[]" value="{{$purchase->qty}}"  class="form-control form-control-sm qty" /></td>
                            <td><input type="text" name="total[]" value="{{$purchase->total_price}}" class="form-control form-control-sm total" readonly/></td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">Total</td>
                        <td><input type="text" name="total_qty" value="{{$purchase->total_qty}}" class="form-control form-control-sm total_qty" readonly/></td>
                        <td><input type="text" name="grand_total" value="{{$purchase->grand_total}}"  class="form-control form-control-sm grand_total" readonly/></td>
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
        <div class="row col-md-12 mb-2">
            &emsp;
            <div class="form-group m-auto">
                <button class="btn btn-primary">Update</button>
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
