<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $title = 'Dashboard';

        return view('index',compact('title'));
    }
}
