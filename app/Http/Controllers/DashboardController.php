<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index(){

        $count_customers = DB::table('customers')->count();
        $total_category = DB::table('category')->count();
        $total_subcategory = DB::table('subcategory')->count();
        $total_product = DB::table('product')->count();
        $total_items = DB::table('items')->count();
        $total_orders = DB::table('order as o')->count();

        $recent_order = DB::table('order as o')
                       ->leftJoin('customers as c','o.c_id','=','c.id')
                       ->select('o.*','c.c_name as customer_name')
                       ->where('o.status', '!=', 'delivered') 
                       ->get();

        $order_return = DB::table('order_return as r')
                       ->leftJoin('customers as c','r.customer_id','=','c.id')
                       ->select('r.*','c.c_name as customer_name')
                       ->where('r.status', '!=', 'Received') 
                       ->get();




        // $count_customers = DB::table('customers as c')->count();
        // $total_orders = DB::table('order as o')->count();

         return view('dashboard',compact('count_customers','total_category','total_subcategory','total_product','total_items','total_orders','recent_order','order_return'));
    }
}
