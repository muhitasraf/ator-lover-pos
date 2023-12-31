<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Capacity;
use App\Models\Purchase;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $title = 'All purchase List';
        $purchase_data = DB::table('tran_master')->where('tran_type','=','1')->paginate(5);
        return view('purchase.index',compact('title','purchase_data'));
    }

    public function create()
    {
        $title = 'Create New Purchase';
        $brand_data = Brand::get();
        $type_data = Type::get();
        $prev_invoice_no = collect(DB::select("SELECT invoice_no FROM tran_master ORDER BY id DESC LIMIT 1"))->first();
        if(!empty($prev_invoice_no->invoice_no)){
            $prev_invoice_str = substr($prev_invoice_no->invoice_no,0,8);
            $prev_invoice_num = substr($prev_invoice_no->invoice_no,8,strlen($prev_invoice_no->invoice_no));
            $new_invoice_no = $prev_invoice_str.sprintf('%08d', $prev_invoice_num + 1);
        }else{
            $new_invoice_no = "PU-".date("Y")."-00000000";
        }
        return view('purchase.create',compact('title','brand_data','type_data','new_invoice_no'));
    }

    public function store(Request $request)
    {
        $tran_master_data = [
            "invoice_no" => $request->input('invoice_no'),
            "total_qty" => $request->input('total_qty'),
            "grand_total" => $request->input('grand_total'),
            "tran_date" => date('Y-m-d'),
            "tran_type" => 1
        ];

        $tran_id = DB::table('tran_master')->insertGetId($tran_master_data);

        $stock_in_data = [];

        for($i=0; $i<count($request->input('brand_name')); $i++){
            $product_name = $request->input('product_name')[$i];
            $capacity_id = $request->input('capacity')[$i];
            $product_id = DB::table('products')->where('product_name',$product_name)->where('capacity_id',$capacity_id)->first()->id;
            $stock_in_data[] = [
                "tran_id" => $tran_id,
                "brand_id" => $request->input('brand_name')[$i],
                "product_id" => $product_id,
                "capacity_id" => $capacity_id,
                "price" => $request->input('price')[$i],
                "qty" => $request->input('qty')[$i],
                "total_price" => $request->input('total')[$i]
            ];
        }

        $result = DB::table('stock_in')->insert($stock_in_data);

        if($result){
            return redirect('purchase');
        }
    }

    public function show($id)
    {
        $title = 'Single Purchase';
        $purchase_data = DB::table('stock_in')
                        ->select('stock_in.qty','stock_in.price','stock_in.total_price','capacities.capacity_name','brands.brand_name',
                        'products.product_name','tran_master.invoice_no', 'tran_master.total_qty','tran_master.tran_date',
                        'tran_master.grand_total as grand_total')
                        ->leftJoin('tran_master', 'stock_in.tran_id', '=', 'tran_master.id')
                        ->leftJoin('brands', 'stock_in.brand_id', '=', 'brands.id')
                        ->leftJoin('capacities', 'stock_in.capacity_id', '=', 'capacities.id')
                        ->leftJoin('products', 'stock_in.product_id', '=', 'products.id')
                        ->where('tran_id',$id)->get();
        return view('purchase/show',compact('title','purchase_data'));
    }

    public function edit($id)
    {
        $title = 'Edit Purchase';
        $purchase_data = DB::table('tran_master')
                        ->leftJoin('stock_in', 'tran_master.id', '=', 'stock_in.tran_id')
                        ->where('tran_master.id',$id)->get();
        $brand_data = Brand::all();
        $type_data = Type::all();
        $capacity_data = Capacity::all();
        $products = DB::table('products')->select('id','product_name')->get();
        return view('purchase/edit',compact('title','purchase_data','brand_data','products','type_data','capacity_data','id'));
    }

    public function update(Request $request, $id)
    {
        $tran_master_data = [
            "invoice_no" => $request->input('invoice_no'),
            "total_qty" => $request->input('total_qty'),
            "grand_total" => $request->input('grand_total'),
            "tran_date" => date('Y-m-d'),
            "tran_type" => 1
        ];

        $tran_id = $request->input('tran_id');

        DB::table('tran_master')->where('id',$id)->update($tran_master_data);

        DB::table('stock_in')->where('tran_id',$tran_id)->delete();

        $stock_in_data = [];

        for($i=0; $i<count($request->input('brand_name')); $i++){
            $product_name = $request->input('product_name')[$i];
            $capacity_id = $request->input('capacity')[$i];
            $product_id = DB::table('products')->where('product_name',$product_name)->where('capacity_id',$capacity_id)->first()->id;
            $stock_in_data[] = [
                "tran_id" => $tran_id,
                "brand_id" => $request->input('brand_name')[$i],
                "product_id" => $product_id,
                "capacity_id" => $capacity_id,
                "price" => $request->input('price')[$i],
                "qty" => $request->input('qty')[$i],
                "total_price" => $request->input('total')[$i]
            ];
        }

        $result = DB::table('stock_in')->insert($stock_in_data);

        if($result){
            return redirect('purchase');
        }
    }

    public function destroy($id)
    {
        $result = DB::table('tran_master')->where('id',$id)->delete();
        $result = DB::table('stock_in')->where('tran_id',$id)->delete();
        if($result){
            return redirect('purchase');
        }
    }

    public function product_by_brand(Request $request){
        $brand_id = $request->brand_id;
        $products = DB::table('products')->select('id','product_name')->where('brand_id','=',$brand_id)->groupBy('product_name')->get();
        return response()->json($products);
    }

    public function product_details(Request $request){
        $product_id = $request->product_id;
        $product_details = DB::table('products')->where('id','=',$product_id)->first();
        return response()->json($product_details);
    }

    public function capacity_by_product(Request $request){
        $product_name = $request->product_name;
        $capacity_name = DB::table('products')
                        ->select('capacities.id','capacities.capacity_name')
                        ->leftJoin('capacities', 'products.capacity_id', '=', 'capacities.id')
                        ->where('product_name','=',$product_name)->get();
        return response()->json($capacity_name);
    }
}
