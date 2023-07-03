@extends('index')
    @section('content')
    <div class="row">
        <div class="col col-md-12">
            <a class="btn btn-success btn-sm mb-3" href="{{ route('purchase.create')}}">
                New Purchase
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 5%;">SL.</th>
                            <th style="width: 15%;">Invoice No</th>
                            <th style="width: 10%;">Total Qty</th>
                            <th style="width: 10%;">Total Price</th>
                            <th style="width: 10%;">Tran Date</th>
                            <th style="width: 20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales_data as $key=>$sales)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $sales->invoice_no}}</td>
                                <td>{{ $sales->total_qty}}</td>
                                <td>{{ $sales->grand_total}}</td>
                                <td>{{ $sales->tran_date}}</td>

                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ URL::to('sales/'.$sales->id ) }}">
                                        <i class="fa-sharp fa-solid fa-file-invoice-dollar"></i> Invoice
                                    </a>
                                    <a class="btn btn-success btn-sm" href="{{ URL::to('sales/'.$sales->id.'/edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('sales.destroy', $sales->id ) }}" method="post">
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
            </div>
        </div>
    </div>
@stop
