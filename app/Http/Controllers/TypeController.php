<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $title = 'Type List';
        $type_name = Type::get();
        return view('type/index',compact('title','type_name'));
    }

    public function create()
    {
        $title = 'Create Product Type';
        return view('type/create',compact('title'));
    }

    public function store(Request $request)
    {
        $type = new Type();
        $type->type_name = $request->input('type_name');
        $type->status = $request->input('status');
        $type->created_by = 1;
        $result = $type->save();
        if($result){
            return redirect('type');
        }
    }

    public function show($id)
    {
        $title = 'Type';
        $type_name = Type::where('id',$id)->first();
        return view('type/show',compact('title','type_name'));
    }

    public function edit($id)
    {
        $title = 'Type Name Edit';
        $type_name = Type::where('id',$id)->first();
        return view('type/edit',compact('title','type_name'));
    }

    public function update(Request $request, $id)
    {
        $type = Type::find($id);
        $type->type_name = $request->input('type_name');
        $type->status = $request->input('status');
        $type->updated_by = 1;
        $result = $type->save();
        if($result){
            return redirect('type');
        }
    }

    public function destroy($id)
    {
        $result = Type::where('id',$id)->delete();
        if($result){
            return redirect('type');
        }
    }
}
