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
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchase_data as $key=>$purchase)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $purchase->invoice_no}}</td>
                                <td>{{ $purchase->total_qty}}</td>
                                <td>{{ $purchase->grand_total}}</td>
                                <td>{{ $purchase->tran_date}}</td>

                                <td>
                                    <a class="btn btn-success btn-sm" href="{{ URL::to('purchase/'.$purchase->id.'/edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="btn btn-success btn-sm" href="{{ URL::to('purchase/'.$purchase->id ) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <form action="{{ route('purchase.destroy', $purchase->id ) }}" method="post">
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
