<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Capacity;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'All Product List';
        $product_data = Product::with('brand','type','capacity')->paginate(5);
        return view('product.index',compact('title','product_data'));
    }

    public function create()
    {
        $title = 'Create New Product';
        $brand_data = Brand::get();
        $type_data = Type::get();
        $capacity_data = Capacity::get();
        return view('product.create',compact('title','brand_data','type_data','capacity_data'));
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->brand_id = $request->input('brand_name');
        $product->capacity_id = $request->input('capacity');
        $product->type_id = $request->input('type');
        $product->details = $request->input('details');
        $product->status = $request->input('status');
        $product->created_by = 1;
        $result = $product->save();
        if($result){
            return redirect('product');
        }
    }

    public function show($id)
    {
        $title = 'Single Product';
        $product_data = Product::with('brand')->where('id',$id)->first();
        return view('product/show',compact('title','product_data'));
    }

    public function edit($id)
    {
        $title = 'Edit Product';
        $product_data = Product::where('id',$id)->first();
        $brand_data = Brand::all();
        $type_data = Type::all();
        $capacity_data = Capacity::get();
        return view('product/edit',compact('title','product_data','brand_data','type_data','capacity_data','id'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->product_name = $request->input('product_name');
        $product->brand_id = $request->input('brand_name');
        $product->capacity_id = $request->input('capacity');
        $product->type_id = $request->input('type');
        $product->details = $request->input('details');
        $product->status = $request->input('status');
        $product->updated_by = 1;
        $result = $product->save();
        if($result){
            return redirect('product');
        }
    }

    public function destroy($id)
    {
        $result = Product::where('id',$id)->delete();
        if($result){
            return redirect('brands');
        }
    }
}
