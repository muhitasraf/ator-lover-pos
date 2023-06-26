<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'All Brand List';
        $brand_data = Product::paginate(10);
        return view('brand.index',compact('title','brand_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Create New Brand';
        return view('brand.create',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = new Product();
        $brand->brand_name = $request->input('brand_name');
        $brand->description = $request->input('description');
        $brand->status = $request->input('status');
        $brand->created_by = 1;
        $brand->created_at = date('Y-m-d');

        $result = $brand->save();
        if($result){
            return redirect('brands');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Single Brand';
        $brand_data = Product::where('id',$id)->first();
        return view('brand/show',compact('title','brand_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Brand Name Edit';
        $title = 'Single Brand';
        $brand_data = Product::where('id',$id)->first();
        return view('brand/edit',compact('title','brand_data','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand = Product::find($id);
        $brand->brand_name = $request->input('brand_name');
        $brand->description = $request->input('description');
        $brand->status = $request->input('status');
        $brand->updated_by = 1;
        $brand->updated_at = date('Y-m-d');

        $result = $brand->save();

        if($result){
            return redirect('brands');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Product::where('id',$id)->delete();
        if($result){
            return redirect('brands');
        }
    }
}
