<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Type;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'All Product List';
        $product_data = Product::with('brand','type')->paginate(5);
        return view('product.index',compact('title','product_data'));
    }

    public function create()
    {
        $title = 'Create New Product';
        $brand_data = Brand::get();
        $type_data = Type::get();
        return view('product.create',compact('title','brand_data','type_data'));
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->product_name = $request->input('product_name');
        $product->brand_id = $request->input('brand_name');
        $product->capacity = $request->input('capacity');
        $product->type = $request->input('type');
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
        return view('product/edit',compact('title','product_data','brand_data','type_data','id'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->product_name = $request->input('product_name');
        $product->brand_id = $request->input('brand_name');
        $product->capacity = $request->input('capacity');
        $product->type = $request->input('type');
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
