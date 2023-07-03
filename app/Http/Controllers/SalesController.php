<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Capacity;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index()
    {
        $title = 'All Sales List';
        $sales_data = DB::table('tran_master')->where('tran_type','=','2')->paginate(5);
        return view('sales.index',compact('title','sales_data'));
    }

    public function create()
    {
        $title = 'Create New Sales';
        $brand_data = Brand::get();
        $type_data = Type::get();
        $prev_invoice_no = collect(DB::select("SELECT invoice_no FROM tran_master WHERE tran_type = 2 ORDER BY id DESC LIMIT 1"))->first();
        if(!empty($prev_invoice_no->invoice_no)){
            $prev_invoice_str = substr($prev_invoice_no->invoice_no,0,8);
            $prev_invoice_num = substr($prev_invoice_no->invoice_no,8,strlen($prev_invoice_no->invoice_no));
            $new_invoice_no = $prev_invoice_str.sprintf('%08d', $prev_invoice_num + 1);
        }else{
            $new_invoice_no = "SA-".date("Y")."-00000000";
        }
        return view('sales.create',compact('title','brand_data','type_data','new_invoice_no'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $customer_data = [
            "customer_name" => $request->input('customer_name'),
            "customer_number" => $request->input('customer_number'),
            "customer_address" => $request->input('customer_address'),
        ];

        $tran_master_data = [
            "invoice_no" => $request->input('invoice_no'),
            "total_qty" => $request->input('total_qty'),
            "grand_total" => $request->input('grand_total'),
            "total_discount" => $request->input('total_discount'),
            "tran_date" => date('Y-m-d'),
            "tran_type" => 2
        ];

        $tran_id = DB::table('tran_master')->insertGetId($tran_master_data);

        $stock_out_data = [];

        for($i=0; $i<count($request->input('brand_name')); $i++){
            $product_name = $request->input('product_name')[$i];
            $capacity_id = $request->input('capacity')[$i];
            $product_id = DB::table('products')->where('product_name',$product_name)->where('capacity_id',$capacity_id)->first()->id;
            $stock_out_data[] = [
                "tran_id" => $tran_id,
                "brand_id" => $request->input('brand_name')[$i],
                "product_id" => $product_id,
                "capacity_id" => $capacity_id,
                "price" => $request->input('price')[$i],
                "qty" => $request->input('qty')[$i],
                "discount_amt" => $request->input('discount_amt')[$i],
                "total_price" => $request->input('total')[$i]
            ];
        }

        $result = DB::table('stock_out')->insert($stock_out_data);

        if($result){
            return redirect('sales');
        }
    }

    public function show($id)
    {
        $title = 'Single Sales';
        $sales_data = DB::table('stock_out')
                        ->select('stock_out.qty','stock_out.price','stock_out.discount_amt','stock_out.total_price','capacities.capacity_name','brands.brand_name',
                        'products.product_name', 'tran_master.total_discount', 'tran_master.invoice_no', 'tran_master.total_qty','tran_master.tran_date',
                        'tran_master.grand_total as grand_total')
                        ->leftJoin('tran_master', 'stock_out.tran_id', '=', 'tran_master.id')
                        ->leftJoin('brands', 'stock_out.brand_id', '=', 'brands.id')
                        ->leftJoin('capacities', 'stock_out.capacity_id', '=', 'capacities.id')
                        ->leftJoin('products', 'stock_out.product_id', '=', 'products.id')
                        ->where('tran_id',$id)->get();
        return view('sales.show',compact('title','sales_data'));
    }

    public function edit($id)
    {
        $title = 'Edit sales';
        $sales_data = DB::table('tran_master')
                        ->leftJoin('stock_out', 'tran_master.id', '=', 'stock_out.tran_id')
                        ->where('tran_master.id',$id)->get();
        $brand_data = Brand::all();
        $type_data = Type::all();
        $capacity_data = Capacity::all();
        $products = DB::table('products')->select('id','product_name')->get();
        return view('sales/edit',compact('title','sales_data','brand_data','products','type_data','capacity_data','id'));
    }

    public function update(Request $request, $id)
    {
        $tran_master_data = [
            "invoice_no" => $request->input('invoice_no'),
            "total_qty" => $request->input('total_qty'),
            "grand_total" => $request->input('grand_total'),
            "total_discount" => $request->input('total_discount'),
            "tran_date" => date('Y-m-d'),
            "tran_type" => 1
        ];

        $tran_id = $request->input('tran_id');

        DB::table('tran_master')->where('id',$id)->update($tran_master_data);

        DB::table('stock_out')->where('tran_id',$tran_id)->delete();

        $stock_out_data = [];

        for($i=0; $i<count($request->input('brand_name')); $i++){
            $product_name = $request->input('product_name')[$i];
            $capacity_id = $request->input('capacity')[$i];
            $product_id = DB::table('products')->where('product_name',$product_name)->where('capacity_id',$capacity_id)->first()->id;
            $stock_out_data[] = [
                "tran_id" => $tran_id,
                "brand_id" => $request->input('brand_name')[$i],
                "product_id" => $product_id,
                "capacity_id" => $capacity_id,
                "price" => $request->input('price')[$i],
                "qty" => $request->input('qty')[$i],
                "discount_amt" => $request->input('discount_amt')[$i],
                "total_price" => $request->input('total')[$i]
            ];
        }

        $result = DB::table('stock_out')->insert($stock_out_data);

        if($result){
            return redirect('sales');
        }
    }

    public function destroy($id)
    {
        $result = DB::table('tran_master')->where('id',$id)->delete();
        $result = DB::table('stock_out')->where('tran_id',$id)->delete();
        if($result){
            return redirect('sales');
        }
    }

    public function product_details(Request $request){
        $product_name = $request->product_name;
        $capacity_id = $request->capacity_id;
        $product_id = DB::table('products')->where('capacity_id','=',$capacity_id)->where('product_name','=',$product_name)->first()->id;
        $product_details = DB::table('stock_in')->where('product_id','=',$product_id)->where('capacity_id','=',$capacity_id)->first();
        return response()->json($product_details);
    }
}
