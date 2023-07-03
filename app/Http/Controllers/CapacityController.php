<?php

namespace App\Http\Controllers;

use App\Models\Capacity;
use Illuminate\Http\Request;

class CapacityController extends Controller
{
    public function index()
    {
        $title = 'Capacity List';
        $capacity_name = Capacity::get();
        return view('capacity/index',compact('title','capacity_name'));
    }

    public function create()
    {
        $title = 'Create Product Capacity';
        return view('capacity/create',compact('title'));
    }

    public function store(Request $request)
    {
        $capacity = new Capacity();
        $capacity->capacity_name = $request->input('capacity_name');
        $capacity->status = $request->input('status');
        $capacity->created_by = 1;
        $result = $capacity->save();
        if($result){
            return redirect('capacity');
        }
    }

    public function show($id)
    {
        $title = 'Capacity';
        $capacity_name = Capacity::where('id',$id)->first();
        return view('capacity/show',compact('title','capacity_name'));
    }

    public function edit($id)
    {
        $title = 'capacity Name Edit';
        $capacity_name = Capacity::where('id',$id)->first();
        return view('capacity/edit',compact('title','capacity_name'));
    }

    public function update(Request $request, $id)
    {
        $capacity = Capacity::find($id);
        $capacity->capacity_name = $request->input('capacity_name');
        $capacity->status = $request->input('status');
        $capacity->updated_by = 1;
        $result = $capacity->save();
        if($result){
            return redirect('capacity');
        }
    }

    public function destroy($id)
    {
        $result = Capacity::where('id',$id)->delete();
        if($result){
            return redirect('capacity');
        }
    }
}
