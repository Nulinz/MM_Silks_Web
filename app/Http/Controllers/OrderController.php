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
   
    //order return list
    public function return_list()
    {


        $code_drop = DB::table('items')->select('code','id')->get();
          // Returns Collection of objects
          //dd($code_drop);

        


        // Fetch order returns
        $odr_relist = DB::table('order_return')
            ->leftJoin('customers', 'order_return.customer_id', '=', 'customers.id')
            ->select('order_return.*', 'customers.c_name as customer_name')
            ->get();
    
        // Fetch all items ONCE and key by 'code'
        $items = DB::table('items')
            ->select('code', 'i_logo')
            ->get()
            ->keyBy('code');
    
        // Map through order returns and match codes with items
        $data = $odr_relist->map(function ($return) use ($items) {
            $returnCodes = json_decode($return->return_code, true); // Decode first
        
            $matchedItems = [];
        
            if (is_array($returnCodes)) {
                // Since your JSON is like ["202,203,301"], get the first element and explode it
                $codesArray = explode(',', $returnCodes[0]);
        
                foreach ($codesArray as $code) {
                    $code = trim($code); // Ensure no spaces
                    if (isset($items[$code])) {
                        $matchedItems[] = [
                            'final_code' => $code,
                            'final_image' => $items[$code]->i_logo,
                        ];
                    }
                }
            }
        
            $return->matched_items = $matchedItems;
        
            return $return;
        });
        
        //dd($data);
        // Pass the processed data to view
        return view('return.list', ['odr_relist' => $data,'code_drop'=>$code_drop]);
    }

    public function return_status_update(Request $request)
    {
        //dd($request->all());
       $updateData = [
        'status' => $request->status];

      $order_status_update = DB::table('order_return')->where('id', $request->return_id)->update($updateData);

    }

    public function return_code_update(Request $request)
{
    // Validate if item_code is present
    //dd($request->all());
    if (!isset($request->item_code) || !is_array($request->item_code)) {
        return response()->json(['error' => 'No item codes provided'], 400);
    }
    
    
    $updatestatus = [
        'status' => $request->status];

      $order_status_update = DB::table('order_return')->where('order_id', $request->order_id)->update($updatestatus);

    


    //item table update
    $updateData = [
        'status' => 'Active'
    ];

    foreach ($request->item_code as $code) {
        $code = trim($code);

        DB::table('items')
            ->where('code', $code)
            ->update($updateData);
    }
    return back();

    // return response()->json(['success' => 'Status updated successfully']);
}


    /*
    public function item_return(Request $request)
    {
        $returnId = $request->return_id;
    
        // Fetch the order_return record
        $orderReturn = DB::table('order_return')->where('id', $returnId)->first();
    
        if (!$orderReturn) {
            return response()->json(['status' => 'error', 'message' => 'Order Return not found.']);
        }
    
        // Decode return_code (could be JSON array or comma-separated string)
        $itemcode = [];
    
        $itemcode = json_decode($orderReturn->return_code, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            // If not JSON, fallback to comma-separated string
            $itemcode = explode(',', $orderReturn->return_code);
        } elseif (is_array($itemcode) && count($itemcode) === 1 && str_contains($itemcode[0], ',')) {
            // Special Case: It's ["11,12,13"] -> explode the inner string
            $itemcode = explode(',', $itemcode[0]);
        }

    
        $itemcode = array_map('trim', $itemcode);  // Clean spaces

        //dd($itemIds);
    
        if (empty($itemcode)) {
            return response()->json(['status' => 'error', 'message' => 'No item codes found.']);
        }
    
        // Loop through item_ids to toggle status in items table
        foreach ($itemcode as $itemCode) {
            $item = DB::table('items')->where('code', $itemCode)->first();
        
            if ($item) {
                $newStatus = ($item->status === 'Active') ? 'Inactive' : 'Active';
                DB::table('items')->where('code', $itemCode)->update(['status' => $newStatus]);
            }
        }
    
        return response()->json(['status' => 'success', 'message' => 'Items status updated successfully.']);
    }
    
*/



}
