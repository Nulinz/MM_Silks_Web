<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Item;
use App\Models\Customer;


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
        ->select('c.*','o.*','o.created_at as order_date','o.status as odr_status','o.id as odr_primaryid','transport_name')
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
               'status' => $req->odr_status,
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
        return back();
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

 


public function updateLRN(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:order,order_id',
        'lrn_no' => 'required|string|max:255',
        'lrn_image'=>'required',
        'order_status'=>'required'
    ]);
    //dd($request->all());
    //Log::info('LRN form submitted', $request->all());

    $image = $request->file('lrn_image');
    $filename = time() . '_' . $image->getClientOriginalName();
    $image->move(public_path('image/lrn_image'), $filename);   

    $updateData = [
        'lrn_no' => $request->lrn_no,
        'lrn_image' => $filename,
        
    ];

    $update_lrn_no = DB::table('order')->where('order_id', $request->order_id)->update($updateData);
    // dd($request->all());
    // Log::info('LRN form submitted', $request->all());

    //$order = Order::where('order_id', $request->order_id)->first();
    // $order->lrn_no = $request->lrn_no;
    // //$order->status = $request->status ?? $order->status;
    // $order->save();

    return response()->json([
        'message' => 'LRN updated successfully',
        //'lrn_no' => $order->lrn_no
    ]);
}


//barcode

public function checkBarcode(Request $request)
{
    $barcode = $request->input('barcode');
    $customer_id = $request->input('customer_id');

    // Fetch the item and its related customer and subcategory
    $customer = Customer::find($customer_id);
   // Log::info('Customer ID:', ['id' => $customer_id]);
   //Log::info('Customer Data:', ['customer' => $customer]);


    if (!$customer) {
        return response()->json([
            'exists' => false,
            'message' => 'Customer not found'
        ]);
    }
    $item = Item::where('code', $barcode)
    ->where('items.status', 'Active')
    // ->join('customers', 'customers.id', '=',  $customer_id) // Ensure correct relationship
    ->join('subcategory', 'subcategory.id', '=', 'items.sc_id') // Ensure correct subcategory relation (fix the typo here)
    ->first([
        'items.*',  // All columns from items table
         'items.id as item_id',
         'items.i_logo as item_logo',

        'subcategory.id as subcategory_id',
        // 'customers.c_type',  // Customer type (A, B, etc.)
        'subcategory.cat_a', // Subcategory prices
        'subcategory.cat_b',
        'subcategory.cat_c'
    ]);

        //dd($item);
    $price = null;
    
    if ($item) {
        // Determine price based on customer type
        switch ($customer->c_type) {
            case 'A':
                $price = $item->cat_a;
                break;
            case 'B':
                $price = $item->cat_b;
                break;
            case 'C':
                $price = $item->cat_c;
                break;
            default:
                $price = $item->cat_a; // fallback
                break;
        }

        return response()->json([
            'exists' => true,
            'item' => [
                'i_code' => $item->code,
                'item_logo' => $item->item_logo,
                'item_id' => $item->item_id,
                'customer_id' => $customer_id,
                'subcategory_id' => $item->subcategory_id,
                'price' => $price
            ]
        ]);
    } else {
        return response()->json([
            'exists' => false,
            'message' => 'No item found or status inactive'
        ]);
    }
}

//mycart add

public function submitCart(Request $request)
{
    
    $customer_id = $request->input('customer_id');
    $items = $request->input('items');

    //info('Customer ID:', ['customer_id' => $request->input('customer_id')]);
    //info('Items:', $request->input('items'));

    

    if (!$customer_id || empty($items)) {
        return response()->json(['message' => 'Invalid data'], 400);
    }

    
    $lastOrder = DB::table('order')->orderBy('id', 'desc')->first();
    if ($lastOrder) {
        $lastId = $lastOrder->order_id;
        //info("Last Order ID: " . $lastId);
        $newOrderId = str_pad(intval($lastId) + 1, 4, '0', STR_PAD_LEFT);
    } else {
        $newOrderId = '0001';
    }
    //info("New Order ID: " . $newOrderId);


   
        // Assuming you have a MyCart model for `mycart` table
        foreach ($items as $item) {
            DB::table('mycart')->insert([   
                'c_id' => $customer_id,
                'item_id' => $item['item_id'],
                'subcategory_id' => $item['item_subcategoryid'],   // make sure the item object contains 'id'
                'qty' => $item['item_qty'],
                'amount' => $item['item_price'],
                'order_id'=> $newOrderId,
                'c_by' =>1,
                'created_at' => now(),      // if you have timestamps
                'updated_at' => now()
            ]);
   // }
   
}
    //sum quantity
    $sum_quantity = DB::table('mycart')
    ->where('order_id', $newOrderId)
    ->where('status', 'Active')
    ->sum('qty');
   
    //amount sum
    $sum_amount = DB::table('mycart')
    ->where('order_id', $newOrderId)
    ->where('status', 'Active')
    ->sum('amount');
     
    //order table insert
    $orderId = DB::table('order')->insertGetId([
        'c_id' => $customer_id,
        'order_id' => $newOrderId,
        'lrn_no' =>1,
        // 'lrn_image'=>"null",
         'amount' => $sum_amount,
        'no_of_products' =>$sum_quantity,
        'status' => 'confirmed',
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    //mycart table order id status to be inactive
    DB::table('mycart')
    ->where('order_id', $newOrderId)
    ->update([
        'status' => 'Inactive',
         'updated_at' => now(),
    ]);

    //new orer matched items get 
    $itemIds = DB::table('mycart')
    ->where('order_id', $newOrderId)
    ->pluck('item_id');  // Fetch item_ids as Collection

    if ($itemIds->isEmpty()) {
        // No items found in mycart for this order
        return response()->json(['status' => 'error', 'message' => 'No items found for this Order.']);
    }

    // Step 2: Update status to 'Inactive' in items table for matching item_ids
    DB::table('items')
        ->whereIn('id', $itemIds)
        ->update([
            'status' => 'Inactive',
            'updated_at' => now(),
        ]);

    return response()->json(['message' => 'Cart submitted successfully!']);
    }

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




