<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Industry};

class DashboardController extends Controller
{
    public function index(){

        $productCount = Product::count();
        $industryCount = Industry::whereNull('deleted_at')->count();
        return view("admin.dashboard.index" , compact('productCount' , 'industryCount'));
    }
}
 