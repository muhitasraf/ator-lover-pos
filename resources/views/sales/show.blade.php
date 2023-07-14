@extends('index')
    @section('content')
    <div class="col col-md-12 table_content">
        <div class="row hide-btn">
            <div class="col col-md-12">
                <a class="btn btn-success btn-sm mb-3" href="{{ route('sales')}}">
                    Sales List
                </a>
                <a class="btn btn-success btn-sm mb-3" href="{{ route('sales.create')}}">
                    New Sales
                </a>
                <button class="btn btn-success btn-sm mb-3" onclick="printDiv('portrait')">
                    Print
                </button>
            </div>
        </div>

        <!-- company details content -->
        <div class="row mb-5">
            <div class="col-md-4">
                <img src="{{asset('uploads/images/attar_lover_logo_white.jpeg')}}" width="150px" height="150px" alt="">
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4 text-right">
                <span style="font-size: 40px;font-weight:bold;">Attar Lover</span>
                <br>Mobile Number : +8801981357914
                <br>+8801981357914
                <br>Email : attarlover2022@gmail.com
                <br>Facebook Page : fb.com/attarlover2022
            </div>
        </div>

        <!-- customer details content -->
        <div class="row mb-5">
            <div class="col-md-4">
                <span style="font-size: 20px;font-weight:bold;">Billed To :</span>
                <br>Customer Name : Md. Ibrahim
                <br>Number : 01837474373
                <br>Address : Dhaka, Mirpur 1
            </div>
            <div class="col-md-4">

            </div>
            <div class="col-md-4 text-right">
                <span style="font-size: 15px">Order ID : {{ $sales_data[0]->invoice_no ?? ''}}</span>
                <br>Date : {{ $sales_data[0]->tran_date }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered mt-2 row_add sales_table">
                    <thead>
                        <tr  class="table-secondary">
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
                            <td colspan="5"><b>Total</b></td>
                            <td>{{$sales_data[0]->total_qty}}</td>
                            <td>{{$sales_data[0]->total_discount}}</td>
                            <td>{{$sales_data[0]->grand_total}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-4 d-flex">
                <span class="mt-auto font-weight-bold h1">
                    Thank you!
                </span>
            </div>
            <div class="col-md-4">
                <img src="{{asset('uploads/images/attar_lover_round_logo.jpeg')}}" width="180px" height="180px" alt="">
            </div>
            <div class="col-md-4">
                <table class="table">
                    <tr>
                        <td><b>Discount </b></td>
                        <td>: {{$sales_data[0]->total_discount}}%</td>
                    </tr>
                    <tr>
                        <td><b>Delevery Charge </b></td>
                        <td>: 100</td>
                    </tr>

                    <tr>
                        <td><span class="h4 font-weight-bold">Total </span></td>
                        <td>: {{$sales_data[0]->grand_total}} Tk</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <img src="{{asset('uploads/images/ibrahim_signature.jpg')}}" width="260px" height="120px" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center" style="margin-top: 190px;">
                <span style="border: 2px solid rgb(77, 73, 73)!important; border-radius:20px; padding:5px;">
                    Warning : Defective product will be returned if not broken.
                </span>
            </div>
        </div>
    </div>

    <script>
        function printDiv(pageView){
            let htmlToPrint = '';
            let divToPrint = document.getElementsByClassName("table_content");
            const newWin = window.open("");

            htmlToPrint = `<style type="text/css" media="print">
                            @page { size: ${pageView}; }
                            table thead > tr.table-secondary > th {
                                background-color: #b3b7bb !important;
                            }
                            .hide-btn{
                                visibility: hidden;
                            }
                        </style>`;

            newWin.document.write(htmlToPrint);
            newWin.document.write('<link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">');
            newWin.document.write(divToPrint[0].outerHTML);
            newWin.document.close();
            // newWin.print();
            // newWin.close();
            setTimeout(function() {
                newWin.print();
                newWin.close();
            }, 90);
        }
    </script>
@stop

