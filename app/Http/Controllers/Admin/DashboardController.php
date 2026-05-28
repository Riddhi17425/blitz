<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductMaster;
use App\Models\ProductEnquiry;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index(){

        $product_count = '1';
        // return $product_count;
        $product_inquiry = 1;
        return view("admin.dashboard.index" , compact('product_count' , 'product_inquiry'));
    }
}
 