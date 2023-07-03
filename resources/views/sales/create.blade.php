@extends('index')
    @section('content')
    <div class="row mb-3">
        <div class="col col-md-12">
            <input type="button" value="Add Row" id="add_row_btn" class="btn btn-sm btn-primary add_row_btn">
            <a class="btn btn-success btn-sm" href="{{ route('sales')}}">
                Sales List
            </a>
        </div>
    </div>

    <!-- company details content -->
    <form action="{{ route('sales.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="font-weight-bold" for="customer_name">Customer Name :</label>
                    <input type="text" name="customer_name" value="" class="form-control form-control-sm customer_name" placeholder="Customer Name">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="font-weight-bold" for="customer_number">Customer Number :</label>
                    <input type="text" name="customer_number" value="" class="form-control form-control-sm customer_number" placeholder="Customer Number">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="font-weight-bold" for="customer_address">Customer Address :</label>
                    <input type="text" name="customer_address" value="" class="form-control form-control-sm customer_address" placeholder="Customer Address">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="font-weight-bold" for="invoice_no">Order No :</label>
                    <input type="text" name="invoice_no" value="{{ $new_invoice_no }}" class="form-control form-control-sm invoice_no" readonly>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="font-weight-bold" for="sales_date">Sales Date :</label>
                    <input type="date" name="tran_date" class="form-control form-control-sm mx-1 tran_date">
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-2 row_add sales_table">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Brand Name</th>
                                <th>Product Name</th>
                                <th>Capacity</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Discount(Taka)</th>
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
                                <td>
                                    <select class="form-control select2_1 select2 capacity" style="width : 100%;" name="capacity[]" id="capacity">
                                        <option value="0">Select Capacity</option>
                                    </select>
                                </td>
                                <td><input type="text" name="price[]" class="form-control form-control-sm price"></td>
                                <td><input type="text" name="qty[]" class="form-control form-control-sm qty"></td>
                                <td><input type="text" name="discount_amt[]" class="form-control form-control-sm discount_amt"></td>
                                <td><input type="text" name="total[]" class="form-control form-control-sm total" readonly></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5"><b>Total</b></td>
                                <td><input type="text" name="total_qty" class="form-control form-control-sm total_qty" readonly></td>
                                <td><input type="text" name="total_discount" class="form-control form-control-sm total_discount" readonly></td>
                                <td><input type="text" name="grand_total" class="form-control form-control-sm grand_total" readonly></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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
    var qty = 0;
    var price = 0;
    var discount_amt = 0;
    var total_discount = 0;
    var total_qty = 0;
    var grand_total = 0;
    $(document).ready(function() {

        $('.sales_table').on('change', '.brand_name',function(){
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
                            option += '<option value="'+ product_data[i].product_name +'">'+ product_data[i].product_name+'</option>';
                        }
                        this_key.closest('tr').find('td select.product_name').empty().append(option);
                    }else{
                        this_key.closest('tr').find('td select.product_name').empty().append(option);
                        toastr.success("Something went wrong!");
                    }
                }
            });
        });

        $('.sales_table').on('change', '.product_name',function(){
            let this_key = $(this);
            let product_name = this_key.find(':selected').text();
            $.ajax({
                url: '{{ URL::to("capacity_by_product") }}',
                type: 'POST',
                data: {'product_name':product_name, '_token' : '{{csrf_token()}}'},
                success: function(result){
                    let capacity_name =  result;
                    let option = '<option value="0">Select Capacity</option>';
                    if(result.length){
                        let capacity_name =  result;
                        for(let i=0; i<capacity_name.length; i++){
                            option += '<option value="'+ capacity_name[i].id +'">'+ capacity_name[i].capacity_name+'</option>';
                        }
                        this_key.closest('tr').find('td select.capacity').empty().append(option);
                    }else{
                        this_key.closest('tr').find('td select.capacity').empty().append(option);
                        toastr.success("Something went wrong!");
                    }
                }
            });
        });

        $('.sales_table').on('change', '.capacity',function(){
            let this_key = $(this);
            let capacity_id = this_key.val();
            let product_name = this_key.closest('tr').find('td select.product_name :selected').text();
            $.ajax({
                url: '{{ URL::to("product_details") }}',
                type: 'POST',
                data: {'product_name':product_name, 'capacity_id' : capacity_id, '_token' : '{{csrf_token()}}'},
                success: function(result){
                    let product_details =  result;
                    this_key.closest('tr').find('td input.price').val(product_details.price);
                    if(product_details.price>0){
                        calculate_price(this_key);
                        calculate_total();
                    }
                }
            });
        });

        $('.sales_table').on('keyup', '.qty, .price, .discount_amt',function(){
            calculate_price(this);
            calculate_total();
        });

    });

    $('table.sales_table').on('click', '.remove_row', async function () {
        await remove_row($(this));
        calculate_total();
    });

    function calculate_price(_this){
        qty = 0; price = 0;
        qty = $(_this).closest('tr').find('td input.qty').val() ?? 0;
        price = $(_this).closest('tr').find('td input.price').val() ?? 0;
        discount_amt = $(_this).closest('tr').find('td input.discount_amt').val() ?? 0;
        $(_this).closest('tr').find('td input.total').val((qty*price)-discount_amt);
    }

    function calculate_total(){
        total_qty = 0;
        grand_total = 0;
        total_discount = 0;
        $('.qty').each(function(){
            if($(this).val()){
                total_qty += parseFloat($(this).val());
            }
        });
        $('.total_qty').val(total_qty);


        $('.total').each(function(){
            if($(this).val()){
                grand_total += parseFloat($(this).val());
            }
        });
        $('.grand_total').val(grand_total);

        $('.discount_amt').each(function(){
            if($(this).val()){
                total_discount += parseFloat($(this).val());
            }
        });
        $('.total_discount').val(total_discount);
    }

</script>
@stop

