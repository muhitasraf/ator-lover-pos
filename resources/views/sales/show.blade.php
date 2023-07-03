@extends('index')
    @section('content')
    <div class="col col-md-12">
        <div class="row">
            <div class="col col-md-12">
                <a class="btn btn-success btn-sm mb-3" href="{{ route('sales')}}">
                    Sales List
                </a>
                <a class="btn btn-success btn-sm mb-3" href="{{ route('sales.create')}}">
                    New Sales
                </a>
            </div>
        </div>

        <!-- company details content -->
        <div class="row mb-5">
            <div class="col-md-4">
                <img src="{{asset('uploads/images/attar_lover_logo_white.jpeg')}}" width="150px" height="150px" alt="">
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <span style="font-size: 40px">Attar Lover</span>
                <br>Mobile Num : +8801981357914
                <br>+8801981357914
                <br>Address : Mirpur 1
                <br>dgdfgd
            </div>
        </div>

        <!-- customer details content -->
        <div class="row mb-5">
            <div class="col-md-4">
                <span style="font-size: 20px">Billing To :</span>
                <br>Mobile Num : +8801981357914<br>Address : Mirpur 1<br>dgdfgd
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4">
                <span style="font-size: 15px">Order ID : {{ $sales_data[0]->invoice_no ?? ''}}</span>
                <br>Date : {{ $sales_data[0]->tran_date }}
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="font-weight-bold" for="invoice_no">Invoice No :</label>
                    {{ $sales_data[0]->invoice_no ?? ''}}
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="font-weight-bold" for="sales_date">Sales Date :</label>
                    {{ $sales_data[0]->tran_date }}
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="font-weight-bold" for="remarks">Remarks :</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped mt-2 row_add sales_table">
                    <thead>
                        <tr>
                            <th>SL NO</th>
                            <th>Brand Name</th>
                            <th>Product Name</th>
                            <th>Capacity</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Discount</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody class="append_row">
                        @foreach ($sales_data as $key => $sales)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>
                                    {{ $sales->brand_name }}
                                </td>
                                <td>
                                    {{ $sales->product_name }}
                                </td>
                                <td>
                                    {{ $sales->capacity_name }}
                                </td>
                                <td>
                                    {{ $sales->price }}
                                </td>
                                <td>
                                    {{ $sales->qty }}
                                </td>
                                <td>
                                    {{ $sales->discount_amt }}
                                </td>
                                <td>
                                    {{ $sales->total_price }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">Total</td>
                            <td>{{$sales_data[0]->total_qty}}</td>
                            <td>{{$sales_data[0]->total_discount}}</td>
                            <td>{{$sales_data[0]->grand_total}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@stop

