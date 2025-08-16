<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EditController extends Controller
{
    //
    public function edit_product(Request $req)
    
    {
        //dd($req->id);
         $product_details =  DB::table('product')->where('id',$req->id)->first(); 
         return response()->json($product_details,200);
    }

    public function edit_category(Request $req)
    
    {
        //dd($req->id);
        // $subcategory_details = DB::table('subcat as s')
        // ->leftJoin('category as c', 's.c_id', '=', 'c.id') 
        //  ->where('s.id', $req->id)
        //  ->select('s.*', 'c.id as category_id', 'c.c_name as category_name','s.id as subcategory_id')
        // ->first();

        $category_details = DB::table('category as c')
        ->leftJoin('product as p', 'p.id', '=', 'c.p_id') 
         ->where('c.id', $req->id)
         ->select('c.*', 'c.id as category_id', 'p.p_name as product_name','p.id as product_id','c.c_logo')
        ->first();

        // $category_details =  DB::table('category as c')->where('c.id',$req->id)->first(); 
        return response()->json($category_details,200);
    }

    public function edit_subcategory(Request $req)
    
    {
       

        $subcategory_details = DB::table('subcategory as s')
        ->leftJoin('product as p', 'p.id', '=', 's.p_id') 
        ->leftJoin('category as c', 'c.id', '=', 's.c_id') 
         ->where('s.id', $req->id)
         ->select('s.*','s.id as subcategory_id','s.sc_name as subcategory_name', 'p.p_name as product_name','p.id as product_id','c.c_name as category_name','c.id as category_id','s.sc_logo')
        ->first();

        // $category_details =  DB::table('category as c')->where('c.id',$req->id)->first(); 
        return response()->json($subcategory_details,200);
    }


    public function edit_items(Request $req)
    
    {
        //dd($req->id);
        // $subcategory_details = DB::table('subcat as s')
        // ->leftJoin('category as c', 's.c_id', '=', 'c.id') 
        //  ->where('s.id', $req->id)
        //  ->select('s.*', 'c.id as category_id', 'c.c_name as category_name','s.id as subcategory_id')
        // ->first();

        $subcategory_details = DB::table('items as i')
        ->leftJoin('subcategory as s', 's.id', '=', 'i.sc_id')
        ->leftJoin('color as c', 'c.id', '=', 'i.i_color')  
         ->where('i.id', $req->id)
         ->select('i.*', 'i.id as item_id', 's.sc_name as subcategory_name','s.id as subcategory_id','i.i_logo','i.code','c.id as color_id','c.co_name as color_name')
        ->first();

        // $category_details =  DB::table('category as c')->where('c.id',$req->id)->first(); 
        return response()->json($subcategory_details,200);
    }

    public function edit_color(Request $req)
    
    {
        //dd($req->id);
         $color_details =  DB::table('color')->where('id',$req->id)->first(); 
         return response()->json($color_details,200);
    }


}
