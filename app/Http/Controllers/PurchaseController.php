<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Purchase;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $title = 'All purchase List';
        $purchase_data = DB::table('tran_master')->paginate(5);
        return view('purchase.index',compact('title','purchase_data'));
    }

    public function create()
    {
        $title = 'Create New purchase';
        $brand_data = Brand::get();
        $type_data = Type::get();
        $prev_invoice_no = collect(DB::select("SELECT invoice_no FROM tran_master ORDER BY id DESC LIMIT 1"))->first();
        if(!empty($prev_invoice_no->invoice_no)){
            $prev_invoice_str = substr($prev_invoice_no->invoice_no,0,9);
            $prev_invoice_num = substr($prev_invoice_no->invoice_no,9,strlen($prev_invoice_no->invoice_no));
            $new_invoice_no = $prev_invoice_str.sprintf('%08d', $prev_invoice_num + 1);
        }else{
            $new_invoice_no = "INV-".date("Y")."-00000000";
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
            $stock_in_data[] = [
                "tran_id" => $tran_id,
                "brand_id" => $request->input('brand_name')[$i],
                "product_id" => $request->input('product_name')[$i],
                "capacity" => $request->input('capacity')[$i],
                "price" => $request->input('price')[$i],
                "qty" => $request->input('qty')[$i],
                "total_price" => $request->input('total')[$i],
                "tran_date" => $request->input('tran_date'),
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
                        ->select('stock_in.capacity','stock_in.qty','stock_in.price','stock_in.total_price','brands.brand_name',
                        'products.product_name','tran_master.invoice_no', 'tran_master.total_qty','tran_master.tran_date',
                        'tran_master.grand_total as grand_total')
                        ->leftJoin('tran_master', 'stock_in.tran_id', '=', 'tran_master.id')
                        ->leftJoin('brands', 'stock_in.brand_id', '=', 'brands.id')
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
        $products = DB::table('products')->select('id','product_name')->get();
        // dd($purchase_data);
        return view('purchase/edit',compact('title','purchase_data','brand_data','products','type_data','id'));
    }

    public function update(Request $request, $id)
    {
        $purchase = Purchase::find($id);
        $purchase->purchase_name = $request->input('purchase_name');
        $purchase->brand_id = $request->input('brand_name');
        $purchase->capacity = $request->input('capacity');
        $purchase->type = $request->input('type');
        $purchase->details = $request->input('details');
        $purchase->status = $request->input('status');
        $purchase->updated_by = 1;
        $result = $purchase->save();
        if($result){
            return redirect('purchase');
        }
    }

    public function destroy($id)
    {
        $result = Purchase::where('id',$id)->delete();
        if($result){
            return redirect('brands');
        }
    }

    public function product_by_brand(Request $request){
        $brand_id = $request->brand_id;
        $products = DB::table('products')->select('id','product_name')->where('brand_id','=',$brand_id)->get();
        return response()->json($products);
    }

    public function product_details(Request $request){
        $product_id = $request->product_id;
        $product_details = DB::table('products')->where('id','=',$product_id)->first();
        return response()->json($product_details);
    }
}
