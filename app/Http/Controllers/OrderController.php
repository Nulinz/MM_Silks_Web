<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    //
    public function order_list()
    {
        $odr_clist = DB::table('order as o')
        ->leftJoin('customers as c', 'c.id', '=', 'o.c_id')
        ->select('c.*','o.*')
        ->get();


        return view('order.list',['odr_clist'=>$odr_clist]);
        //return view('order.list');
    }

    public function order_profile(Request $req)
    {
        //return view('order.profile');
        $odr_cdetails = DB::table('order as o')
        ->where('o.id','=',$req->id)
        ->leftJoin('customers as c', 'c.id', '=', 'o.c_id')
        ->select('c.*','o.*','o.created_at as order_date','o.status as odr_status','o.id as odr_primaryid')
        ->first();
        
        if ($odr_cdetails) {
            $orderDate = Carbon::parse($odr_cdetails->order_date);
            $odr_cdetails->estimated_delivery = $orderDate->copy()->addDays(14)->toDateString(); // e.g., "2025-07-04"
        }
      
        // Get order tracking details
        // $order_tracking = DB::table('order_tracking as ot')
        // ->leftJoin('order as o', 'o.order_id', '=', 'ot.order_id')
        // ->select('ot.*')
        // ->where('o.id', '=', $req->id)
        // ->orderBy('ot.created_at', 'asc')
        // ->get();
        $item_details = DB::table('mycart as m')
        ->leftJoin('items as i', 'i.id', '=', 'm.item_id')
        ->leftJoin('subcategory as s', 's.id', '=', 'm.subcategory_id')
        ->where('m.order_id', '=', $odr_cdetails->order_id)  // correct linkage
        ->select('m.*', 'i.*','s.sc_name as subcategory_name')
        ->get();
       //dd($item_details);
        return view('order.profile',['odr_cdetails'=>$odr_cdetails,'item_details'=>$item_details]);
       // dd($odr_cdetails);
    }


    //order status update


    public function order_status_update(Request $req)
    {
       //dd($req->all());
        $req->validate([
            'odr_primaryid' => 'required|integer|exists:order,id',
            'odr_status' => 'required|string',
            'odr_id' => 'required|string',
           
        ]);
        
        $updateData = [
            'status' => $req->odr_status,];

        $order_status_update = DB::table('order')->where('id', $req->odr_primaryid)->update($updateData);
        $order_details=DB::table('mycart as m')
                      ->leftJoin('items as i', 'i.id', '=', 'm.item_id')
                     ->where('order_id', $req->odr_primaryid)
                     ->select('m.*','i.*')
                     ->get();
        // dd($order_details);

        if ($order_details) {
            return response()->json([
               
               'order_details' => $order_details
               
            ]);
        }
    }


}
