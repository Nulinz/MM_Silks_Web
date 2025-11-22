<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Item;
use App\Models\Color;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ApiCustomerController extends Controller
{
    //customer login 
    public function login(Request $request)
    {
         $validator = Validator::make($request->all(), [
             'c_contact' => 'required|digits:10',
            
         ], [
             'c_contact.required' => 'Mobile No is required.',
             'c_contact.digits' => 'Mobile number must be exactly 10 digits.',
         ]);
 
         if ($validator->fails()) {
             return response()->json([
                 'status'  => 'error',
                 'message' => implode(', ', $validator->errors()->all()),
             ], 422);
         }
 
         $mobileNumber = $request->c_contact;
 
         // Check if user exists - always get fresh data
         $customer = Customer::where('c_contact', $mobileNumber)->latest()->first();
 
         if (!$customer) {
             return response()->json([
                 'status'  => 'success',
                 'message' => 'Customer not registered.',
             ], 200);
         }
         if ($request->is('api/*')) {
            // if($customer->permission_type=='fullallow'){
                if($customer){
                    //$raw_time = $customer->permission_time;
                //  date_default_timezone_set('Asia/Kolkata');

                    // Format it to: Day-Month-Year Hour:Minute:Second
                    //$formatted_time = date('d-m-Y H:i:s', strtotime($raw_time));


                    return response()->json([
                        'status' => 'success',
                        'message' => 'Customer status successfully',
                        'data' => [

                            'id' => $customer->id,
                            'name' => $customer->c_name,
                            'location' => $customer->c_location,
                            'permission_type' => $customer->permission_type,
                            'from_date' =>Carbon::parse($customer->joindate)->format('d-m-Y'),
                            'permission_date' => Carbon::parse($customer->permission_time)->format('d-m-Y'),
                        ]
                    ], 200);
            }
            else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Customer not created',
                ], 500);
            }
        }

        
    }
  
    //get product list
    public function product_list(){

        $product_list = Product::where('status', 'Active')
        ->select('id','p_name')
        ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Product List',
            'product' => $product_list,

        ], 200);
 

    }

    //category list

    public function category_list(Request $request){

        $validator = Validator::make($request->all(), [
                    'product_id'  => 'required|exists:product,id',
                    'customer_id' => 'required|exists:customers,id'],
                    
                    [
                   'product_id.required'  => 'Product id is required.',
                   'customer_id.required' => 'Customer id is required.',
        ]);

                if ($validator->fails()) {
                    return response()->json([
                       'status'  => 'error',
                        'message' => implode(', ', $validator->errors()->all()),
                    ], 422);
             }


            
            $category_list = Category::where('status', 'Active')
            ->where('p_id', $request->product_id)
            ->select('id','c_name','c_logo')
            ->get()
            
               ->map(function ($item) {
            return [
                'id' => $item->id,
                'c_name' => $item->c_name,
                'c_logo' => $item->c_logo
                    ? asset('image/catimage/' . $item->c_logo)
                    : asset('image/catimage/default.png'),
            ];
        });

        return response()->json([
            'status' => 'success',
            'message' => 'Category List',
            'category' => $category_list,
        ], 200);
          
                

    }



    //subcategory list

    public function subcategory_list(Request $request){

        $validator = Validator::make($request->all(), [
                    'category_id'  => 'required|exists:category,id',
                    'customer_id' => 'required|exists:customers,id'],
                    
                    [
                   'category_id.required'  => 'category id is required.',
                   'customer_id.required' => 'Customer id is required.',
        ]);

                if ($validator->fails()) {
                    return response()->json([
                       'status'  => 'error',
                        'message' => implode(', ', $validator->errors()->all()),
                    ], 422);
             }

        $subcategory_list = Subcategory::where('status', 'Active')
        ->where('c_id', $request->category_id)
        ->select('id','sc_name','sc_logo')
        ->get()
        
          
               ->map(function ($item) {
            return [
                'id' => $item->id,
                'sc_name' => $item->sc_name,
                'sc_logo' => $item->sc_logo
                    ? asset('image/subcatimage/' . $item->sc_logo)
                    : asset('image/subcatimage/default.png'),
            ];
        });

        
          

        return response()->json([
            'status' => 'success',
            'message' => 'Subcategory List',
            'subcategory' => $subcategory_list,

        ], 200);
 

    }


    

    
//     public function category_list(Request $request)
//    {
//         // Validation
//         $validator = Validator::make($request->all(), [
//             'product_id'  => 'required|exists:product,id',
//             'customer_id' => 'required|exists:customers,id',
//         ], [
//             'product_id.required'  => 'Product id is required.',
//             'customer_id.required' => 'Customer id is required.',
//         ]);

//         if ($validator->fails()) {
//             return response()->json([
//                 'status'  => 'error',
//                 'message' => implode(', ', $validator->errors()->all()),
//             ], 422);
//         }

        
//         $customer = Customer::where('status', 'Active')
//             ->where('id', $request->customer_id)
//             ->select('id', 'c_type')
//             ->first();

//         if (!$customer) {
//             return response()->json([
//                 'status' => 'error',
//                 'message' => 'Customer not found or inactive.',
//             ], 404);
//         }

       
//         $category_list = Category::where('status', 'Active')
//             ->where('p_id', $request->product_id)
//             ->select('id', 'c_name')
//             ->get();

   
//         $category_list->map(function ($category) use ($customer) 
//         {
//             $subcategories = Subcategory::where('status', 'Active')
//                 ->where('c_id', $category->id)
//                 ->select('id', 'sc_name', 'sc_logo', 'cat_a', 'cat_b', 'cat_c','cat_d','cat_e')
//                 ->get();

//             $subcategories->map(function ($sub) use ($customer) {
//                 $sub->sc_logo = asset('image/subcatimage/' . $sub->sc_logo);

               
                
//                 if ($customer->c_type === 'A') {
//                     $sub->price = $sub->cat_a;
//                 } elseif ($customer->c_type === 'B') {
//                     $sub->price = $sub->cat_b;
//                 } elseif ($customer->c_type === 'C') {
//                     $sub->price = $sub->cat_c;
//                 } 
//                 elseif ($customer->c_type === 'D') {
//                     $sub->price = $sub->cat_d;
//                 } 
//                 elseif ($customer->c_type === 'E') {
//                     $sub->price = $sub->cat_e;
//                 } 
           

            
//                 unset($sub->cat_a, $sub->cat_b, $sub->cat_c, $sub->cat_d, $sub->cat_e);
//                 return $sub;
//             });

//             $category->subcategories = $subcategories;
//             return $category;
//         });

//         return response()->json([
//             'status'  => 'success',
//             'message' => 'Category List',
//             'category' => $category_list,
//         ], 200);
//     }


    //subcategory list
     
     public function items_list(Request $request)
   {
    
        $validator = Validator::make($request->all(), [
            'subcategory_id'  => 'required|exists:subcategory,id',
            'customer_id'  => 'required|exists:customers,id',
        ], [
            'subcategory_id.required'  => 'SubCategory ID is required.',
            'customer_id.required'  => 'Customer ID is required.',
        ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'error',
            'message' => implode(', ', $validator->errors()->all()),
        ], 422);
    }

    // Get customer info
    $customer = Customer::where('status', 'Active')
        ->where('id', $request->customer_id)
        ->select('id', 'c_type')
        ->first();

    if (!$customer) {
        return response()->json([
            'status' => 'error',
            'message' => 'Customer not found or inactive.',
        ], 404);
    }

    // Get subcategories under the category (excluding logo)
    $subcategory_list = Subcategory::where('status', 'Active')
        ->where('id', $request->subcategory_id)
        ->select('id', 'sc_name', 'cat_a', 'cat_b', 'cat_c','cat_d','cat_e','sc_video') // removed sc_logo
        ->get();

    $subcategory_list->map(function ($sub) use ($customer) {
        // Price by customer type
        if ($customer->c_type === 'A') {
            $sub->price = $sub->cat_a;
        } elseif ($customer->c_type === 'B') {
            $sub->price = $sub->cat_b;
        } elseif ($customer->c_type === 'C') {
            $sub->price = $sub->cat_c;
        } 
        elseif ($customer->c_type === 'D') {
            $sub->price = $sub->cat_d;
        } 
        elseif ($customer->c_type === 'E') {
            $sub->price = $sub->cat_e;
        } 

        $sub->sc_video = $sub->sc_video
        ? asset('image/subcatvideos/' . $sub->sc_video)
        : null;
        // Fetch items under subcategory
        $items_list = Item::where('status', 'Active')
            ->where('sc_id', $sub->id)
            ->select('id', 'code', 'sc_id','types', 'i_logo')
            ->get();

        // Process item logos
        $items_list->map(function ($item) use ($customer) {
            $item->i_logo = $item->i_logo
                ? asset('image/itemimage/' . $item->i_logo)
                : asset('image/itemimage/default.png');

                  

                $inCart = DB::table('mycart')
                ->where('item_id', $item->id)
                ->where('c_id', $customer->id)
                ->where('status', 'Active')
                ->exists();
            
                $item->isCart = $inCart;

                
            return $item;
        });

        $sub->items = $items_list;

        // Clean up
        unset($sub->cat_a, $sub->cat_b, $sub->cat_c,$sub->cat_d,$sub->cat_e);
        return $sub;
    });

    return response()->json([
        'status'      => 'success',
        'message'     => 'Subcategory List',
        'subcategory' => $subcategory_list,
    ], 200);
}

//addtocart

public function addToCart(Request $request)
{
    $validator = Validator::make($request->all(), [
        'customer_id'     => 'required|exists:customers,id',
        'item_id'         => 'required|array|min:1',
        'item_id.*'       => 'required|exists:items,id',
        'item_price'      => 'required|array|min:1',
        'item_price.*'    => 'required|string|min:0',
        'subcategory_id'      => 'required|array|min:1', 
        'subcategory_id.*'    => 'required|exists:subcategory,id',
        
        //'subcategory_id'     => 'required|exists:subcategory,id',
    ], [
        'customer_id.required' => 'Customer ID is required.',
        'item_id.required'     => 'Item ID is required.',
        'item_price.required'  => 'Item price is required.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'error',
            'message' => implode(', ', $validator->errors()->all()),
        ], 422);
    }

    $customerId  = $request->customer_id;
    $itemIds     = $request->item_id;
    $itemPrices  = $request->item_price;
    $subcategoryIds  = $request->subcategory_id;

    $singleSubcategory = count($subcategoryIds) === 1;


    foreach ($itemIds as $index => $itemId) {
        $price = $itemPrices[$index] ?? 0;
        $subId = $singleSubcategory
            ? $subcategoryIds[0]
            : ($subcategoryIds[$index] ?? $subcategoryIds[0]);

        DB::table('mycart')->insert([
            'c_id'       => $customerId,
            'item_id'    => $itemId,
            'subcategory_id'    =>  $subId, 
            'qty'        => 1, // default quantity
            'amount'     => $price, // use the price from request
            'c_by'       => 1,
            'status'     => 'Active',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    return response()->json([
        'status'  => 'success',
        'message' => 'Items added to cart with prices from request.',
    ]);
}


public function viewCart(Request $request)
{
    $validator = Validator::make($request->all(), [
        'customer_id' => 'required|exists:customers,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'error',
            'message' => implode(', ', $validator->errors()->all()),
        ], 422);
    }

    $customerId = $request->customer_id;

    $cartItems = DB::table('mycart')
        ->join('items', 'mycart.item_id', '=', 'items.id')
        ->join('subcategory', 'subcategory.id', '=', 'items.sc_id')
        ->where('mycart.c_id', $customerId)
        ->where('mycart.status', 'Active')
        ->select(
            //'mycart.id as cart_id',
            'items.id',
            'items.code',
            'subcategory.sc_name',
            // 'mycart.qty',
            DB::raw('ROUND(mycart.amount) as amount'),
            'items.i_logo',
        
        )
        ->get();
        $cartItems = $cartItems->map(function ($item) {
            $item->i_logo = !empty($item->i_logo)
                ? asset('image/itemimage/' . $item->i_logo)
                : null;
            return $item;
        });

    return response()->json([
        'status' => 'success',
        'data'   => $cartItems,
    ]);
}


//delete cart items

 //deleteCartItem
 public function deleteCartItem(Request $request)
 {
     $validator = Validator::make($request->all(), [
         'customer_id' => 'required|exists:customers,id',
         'item_id'  => 'required|exists:items,id',
     ], [
         'customer_id.required' => 'Customer ID is required.',
         'customer_id.exists'   => 'Customer not found.',
         'item_id.required'  => 'Product ID is required.',
         'item_id.exists'    => 'Product not found.',
     ]);

     if ($validator->fails()) {
         return response()->json([
             'status' => 'error',
             'message' => implode(', ', $validator->errors()->all()),
         ], 422);
     }

     $customerId = $request->input('customer_id');
     $itemId  = $request->input('item_id');

     try {
         // Check if cart item exists
         $cartItem = DB::table('mycart')
             ->where('c_id', $customerId)
             ->where('item_id', $itemId)
             ->where('status', 'active')
             ->first();

         if (!$cartItem) {
             return response()->json([
                 'status' => 'error',
                 'message' => 'Cart item not found or already removed.',
             ], 404);
         }
         DB::table('mycart')
         ->where('id', $cartItem->id)
         ->delete();


         return response()->json([
             'status' => 'success',
             'message' => 'Item removed from cart successfully.',
             'deleted_cart_id' => $cartItem->id,
         ], 200);
     } catch (\Exception $e) {
         return response()->json([
             'status' => 'error',
             'message' => 'Failed to remove item from cart.',
             'error' => $e->getMessage(),
         ], 500);
     }
 }

 public function cartCount(Request $request)
{
    $validator = Validator::make($request->all(), [
        'customer_id' => 'required|exists:customers,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => implode(', ', $validator->errors()->all()),
        ], 422);
    }

    $customerId = $request->customer_id;

    $count = DB::table('mycart')
        ->where('c_id', $customerId)
        ->where('status', 'Active')
        ->count();

    return response()->json([
        'status' => 'success',
        'cart_count' => $count
    ]);
}

//place order

public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'transport_name' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => implode(', ', $validator->errors()->all()),
            ], 422);
        }

        $customerId = $request->customer_id;
        $transport = $request->transport_name;
        
        try {
            // $summary = $this->calculateCartSummary($customerId);

            // if ($summary['item_count'] === 0) {
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'No items in cart to place an order.',
            //     ], 400);
            // }

            $lastOrder = DB::table('order')->orderBy('id', 'desc')->first();
            $newOrderId = $lastOrder ? str_pad(intval($lastOrder->order_id) + 1, 4, '0', STR_PAD_LEFT) : '0001';

            $sum_quantity = DB::table('mycart')
                    ->where('c_id', $customerId)
                    ->where('status', 'Active')
                    ->sum('qty');

          
            
            
        
            


            $orderId = DB::table('order')->insertGetId([
                'c_id' => $customerId,
                'order_id' => $newOrderId,
               // 'amount' => $summary['final_payable_amount'],
                'no_of_products' =>$sum_quantity,
                'status' => 'confirmed',
                'transport_name' => $transport,
                'lrn_no'      =>"N/A",
                'lrn_image' =>0,
                // 'payment_sts' => $paymentSts,
                // 'transaction_id' => $transactionId,
                // 'address_id' => $Address_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    

  

            DB::table('mycart')
                ->where('c_id', $customerId)
                ->where('status', 'Active')
                ->whereNull('order_id')
                ->update([
                    'order_id' => $newOrderId,
                    'status' => 'ordered',
                    'updated_at' => now(),
                ]);
               


            DB::commit();
            $sum_amount = DB::table('mycart')
            ->where('c_id', $customerId)
            ->where('order_id', $newOrderId)
             ->sum('amount');

            //  $deliveryFee = 100; // set your delivery fee here (change as needed)
            //  $order_final_amount = $sum_amount + $deliveryFee;

             //check order table customer id and order id amount should be updated
             DB::table('order')
             ->where('c_id', $customerId)
             ->where('order_id',$newOrderId )
            
             ->update([
                 'amount' => $sum_amount,
                
             ]);

            DB::table('mycart')
            ->where('order_id', $newOrderId)
            ->update([
                'status' => 'Inactive',
                 'updated_at' => now(),
            ]);


            //new mycart table order id fetch items table fetch to  inactive

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

            //end new line

            // $orderId = DB::table('mycart')->insertGetId(['order_id']);
            // $getamount = $this->calculateCartSummary($customerId,$orderId);   //new

            return response()->json([
                'status' => 'success',
                'message' => 'Order placed successfully.',
                //  'order_id' => $newOrderId,
                //  'amount' =>$sum_amount,
                // 'no_of_products' =>$sum_quantity,
                
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to place order. Error: ' . $e->getMessage(),
            ], 500);
        }
    }


    public function getOrderDetails(Request $request)
  {
    // Optional: Validate customer exists
    $validator = Validator::make($request->all(), [
        'customer_id' => 'required|exists:customers,id',
    ], [
        'customer_id.required' => 'Customer ID is required.',
        'customer_id.exists' => 'Customer not found.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => implode(', ', $validator->errors()->all()),
        ], 422);
    }

    $customerId = $request->input('customer_id');

    // Fetch orders
    $rawOrders = DB::table('order')
        ->where('c_id', $customerId)
        ->select(
            'id',
            'order_id',
            'no_of_products',
            'status',
            'lrn_no',
            'lrn_image',
            DB::raw("CAST(ROUND(amount) AS CHAR) as amount"),

            DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y') as created_at"),
          
        )
        ->orderBy('id', 'desc')   //new desc
        ->get();
        $orders = $rawOrders->map(function ($order) {

            $cartItems = DB::table('mycart')
            ->where('order_id', $order->order_id)
            ->select('item_id', 'qty','amount')
            ->get(); 

            $colorMap = DB::table('color')
            ->pluck('co_name', 'id'); 
                    $items = DB::table('items')
            ->whereIn('items.id', $cartItems->pluck('item_id'))
            ->leftJoin('subcategory', 'subcategory.id', '=', 'items.sc_id')
            ->select('items.id', 'items.code','items.types' ,'items.i_color', 'subcategory.sc_name','subcategory.id as sub_id')
            ->get()
            ->map(function ($item) use ($cartItems, $colorMap) {
                $cartItem = $cartItems->firstWhere('item_id', $item->id);
        
                return [
                    'item_id'    => $item->id,
                    'code'       => $item->code,
                    'sc_name'    => $item->sc_name,
                    'sub_id'    => $item->sub_id,
                    // 'types'    => $item->types,
                    'qty'        => $cartItem?->qty ?? 0,
                    'price'      => $cartItem ? round($cartItem->amount) : 0,
                    'color_name' => $colorMap[$item->i_color] ?? 'Unknown',
                ];
            /*
            $items = DB::table('items')
            ->whereIn('id', $cartItems->pluck('item_id'))
             ->leftJoin('subcategory', 'subcategory.id', '=', 'items.sc_id')
            ->select('id', 'code','i_color','sc_name')
            ->get()


             ->map(function ($item) use ($cartItems,$colorMap) {
            // Find matching qty from mycart
            $cartItem = $cartItems->firstWhere('item_id', $item->id);

            return [
                'item_id' => $item->id,
                'code'    => $item->code,
                 'sc_name'    => $item->sc_name,
               'qty'     => $cartItem?->qty ?? 0,
              'price' => $cartItem ? round($cartItem->amount) : 0,
              'color_name' => $colorMap[$item->i_color] ?? 'Unknown',

            ];*/
        });

                return [
                    'id'             => $order->id,
                    'order_id'       => $order->order_id,
                    'no_of_products' => $order->no_of_products,
                    'status'         => $order->status,
                    'amount'         => $order->amount,
                    'lrn_no'         => $order->lrn_no,
                    'file' => $order->lrn_image ? url('image/lrn_image/' . rawurlencode($order->lrn_image)) : null,
                    'created_at'     => $order->created_at,
                    'items'          => $items,
                ];
        });

        

    return response()->json([
        'status' => 'success',
        'orders' => $orders
    ]);
}

//id order primary id base
public function order_summary(Request $request)
  {
    // Optional: Validate customer exists
    $validator = Validator::make($request->all(), [
        'customer_id' => 'required|exists:customers,id',
        'id' => 'required|exists:order,id',
    ], [
        'customer_id.required' => 'Customer ID is required.',
        'customer_id.exists' => 'Customer not found.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => implode(', ', $validator->errors()->all()),
        ], 422);
    }

    $customerId = $request->input('customer_id');
    $orderPrimaryId = $request->input('id');

    // Fetch orders
    // 1. Get order info
        $order = DB::table('order')
        ->where('id', $orderPrimaryId)
        ->select('id','order_id','status', 
        DB::raw("CAST(ROUND(amount) AS CHAR) as total_amount"))
        //DB::raw('ROUND(amount) as total_amount'))
        ->first();

            if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
            }

            // 2. Get related items
            $items = DB::table('mycart as m')
            ->leftJoin('items as i', 'i.id', '=', 'm.item_id')
            ->leftJoin('subcategory as s', 's.id', '=', 'm.subcategory_id')
            ->where('m.order_id', $order->order_id)
            ->select(
                's.sc_name as subcategory_name',
                DB::raw('ROUND(m.amount) as item_price'),
                'i.code as item_code',
                'i.i_logo'
            )
            ->get();
            
           
                           
        
                    foreach ($items as $item) {
            // Check if the item was returned using JSON-aware query
            $isReturned = DB::table('order_return')
                ->where('order_id', $order->order_id)
                ->whereJsonContains('return_code', $item->item_code)
                ->exists();
        
            $item->logo = $item->i_logo 
                ? asset('image/itemimage/' . $item->i_logo)
                : url('uploads/items/default.png');
        
            $item->return_sts = $isReturned;
        
            unset($item->i_logo);
        }


            // 3. Add items into the order object
           
            $order->items = $items;
           

//return response()->json($order);

    return response()->json([
        'status' => 'success',
        'orders' => $order
    ]);
}
  

     //popup version update
    public function popup(Request $request)
    {
        return response()->json(['version' => '0.0.2'], 200);
    }

    

    
public function update_token(Request $request)
{
        $validator = Validator::make($request->all(), [
         'customer_id'        => 'required|exists:customers,id',
         'device_token'   => 'required',
         
     ], [
         'customer_id.required' => 'customer ID is required.',
         'customer_id.exists' => 'customer Id not found.',
         'device_token.required' => 'Device token is required.',
         // 'c_id.exists' => 'customer not found.',
     
     
     ]);

     if ($validator->fails()) {
         $messages = $validator->errors()->all();
         return response()->json([
             'data' => 'error',
             'message' => implode(', ', $messages),
         ], 422);
     }
     $validated = $validator->validated();
 
     $customer = Customer::find($request->customer_id);
     if ($request->is('api/*')) {
             
         if (!$customer) {
                 return response()->json([
                     'message' => 'Customer not found.',
                     'status' => 'fail',
                     
                 ], 404);
             }
             
 
         else{

             $customer->update([
                 'device_token' => $request->device_token,
             ]);
                 return response()->json([
                 'message' => 'Device token updated Successfully.',
                 'status' => 'success',
                //  'token'=>$customer->device_token
                 
                 ], 200);
         }
    }
 
 }  
 
    
    public function logout(Request $request)
    {
        // Validate request
        //Log::info($request->all());
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
        ], [
            'customer_id.required' => 'Device token is required.',
            'customer_id.exists' => 'Device token not found.',
        ]);
        Log::info('Incoming device token:', [$request->device_token]);


        if ($validator->fails()) {
            return response()->json([
                'data' => 'error',
                'message' => implode(', ', $validator->errors()->all()),
            ], 422);
        }

        // Find customer by device token
        $customer = Customer::where('id', $request->customer_id)->first();

        if (!$customer) {
            return response()->json([
                'message' => 'Customer not found.',
                'status' => 'fail',
            ], 404);
        }

        // Clear device token to log out
        $customer->device_token = "";
        $customer->save();

        return response()->json([
            'message' => 'Logged out successfully',
            'status' => 'success'
        ], 200);
    }

    //return orders
    public function order_return(Request $request)
    {
        //Log::info('API Order Return Request:', $request->all());

        
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'order_id'    => 'required|exists:order,order_id',
            'item_code'     => 'required|array|min:1',
            'item_code.*' => 'required',
            'return_file' => 'required|mimes:png,jpg,jpeg,gif,png,pdf,docx',
        ],
        [
            'customer_id.required' => 'Customer ID is required.',
            'customer_id.exists' => 'Customer not found.',
            'order_id.exists' => 'order not found.',
            'return_file' => 'Only png, jpg, jpeg, gif,png,pdf,docx are allowed.',

        ]
    );
    
        if ($validator->fails()) {
            return response()->json([
                'status'  => 'error',
                'message' => $validator->errors()->first(),
            ], 422);
        }
        // $data = [implode(',', $request->item_id)];

        $customerId = $request->customer_id;
        $orderId    = $request->order_id;
        //$itemIds    = $request->item_id; // This is now an array [1, 2, 3]
        $itemcode = $request->item_code; 

        if ($request->is('api/*')) {
            if ($request->hasFile('return_file')) {              
                   
                $image = $request->file('return_file');
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('image/return_file'), $filename);            
               
            }
    
        // Store into DB (Convert Array to JSON String)
            DB::table('order_return')->insert([
                'customer_id' => $customerId,
                'order_id'    => $orderId,
                'return_code' => json_encode([implode(',', $itemcode)]),

                 // Store as JSON array
                'return_image'=>$filename,
                'status'      => 'Active',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
    
            return response()->json([
                'status'  => 'success',
                'message' => 'Items returned successfully.',
                
            ]);
        }
    }


    //product color and id based 

    public function price_filter(Request $request)
  {
    
          //Log::info('Incoming price_filter request', $request->all());
    // Log::info('API Request - price_filter', $request->all());
     
    //   return response()->json([
    //     'status' => 'debug',
    //     'data'   => $request->all(),
    // ]);


    // Step 1: Validate request
    $validator = Validator::make($request->all(), [
        'product_id'  => 'required|exists:product,id',
        'customer_id' => 'required|exists:customers,id',
        'min_price'   => 'required|numeric',
        'max_price'   => 'required|numeric',
        'color_id'    => 'sometimes|array', 
        'color_id.*'  => 'exists:color,id', 
    ],
    // [
    //     'product_id.required'  => 'Product ID is required.',
    //     'product_id.exists'    => 'The selected product does not exist.',
    //     'customer_id.required' => 'Customer ID is required.',
    //     'customer_id.exists'    => 'The selected customer does not exist.',
    //     'min_price.required'   => 'Minimum price is required.',
    //     'min_price.numeric'    => 'Minimum price must be a number.',
    //     'max_price.required'   => 'Maximum price is required.',
    //     'max_price.numeric'    => 'Maximum price must be a number.',
    //     'color_id.array'       => 'Color ID must be an array.',
    //     'color_id.*.exists'    => 'One or more selected colors do not exist.',
    // ]
);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'error',
            'message' => implode(', ', $validator->errors()->all()),
        ], 422);
    }

    // Step 2: Get customer type    
    $customer = Customer::where('status', 'Active')
        ->where('id', $request->customer_id)
        ->select('id', 'c_type')
        ->first();

    if (!$customer) {
        return response()->json([
            'status' => 'error',
            'message' => 'Customer not found or inactive.',
        ], 404);
    }

    // Step 3: Determine price column
    $priceColumn = match ($customer->c_type) {
        'A' => 'cat_a',
        'B' => 'cat_b',
        'C' => 'cat_c',
        'D' => 'cat_d',
        'E' => 'cat_e',
        default => null,
    };

    if (!$priceColumn) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid customer type.',
        ], 400);
    }

    // Step 4: Get subcategories with only needed columns
    $subcategories = Subcategory::where('status', 'Active')
        ->where('p_id', $request->product_id)
        ->select('id', $priceColumn, 'sc_video') // Only the needed price column
        ->get();

    // Step 5: Filter subcategories based on price range
    $filtered = $subcategories->filter(function ($sub) use ($priceColumn, $request) {
        $price = (float) $sub->$priceColumn;
        return $price >= $request->min_price && $price <= $request->max_price;
    });
    
    //Log::info($filtered);

    $responseData = $filtered->map(function ($sub) use ($priceColumn, $request, $customer) {
        // Get all active items linked to the subcategory
        $items = \App\Models\Item::where('sc_id', $sub->id)
            ->where('status', 'Active')
            ->when($request->has('color_id'), function ($query) use ($request) {
                $query->whereIn('i_color', $request->color_id);
            })
            ->select('code', 'i_logo','types','id', 'i_color')
            ->get();
    
        if ($items->isEmpty()) {
            
            return null;
        }
    
        $itemsData = $items->map(function ($item) use ($customer) {
            $inCart = DB::table('mycart')
                ->where('item_id', $item->id)
                ->where('c_id', $customer->id)
                ->where('status', 'Active')
                ->exists();
    
            return [
                'code'    => $item->code,
                'i_logo'  => $item->i_logo
                    ? asset('image/itemimage/' . $item->i_logo)
                    : asset('image/itemimage/default.png'),
                'types'    => $item->types,
                'item_id' => $item->id,
                'isCart'  => $inCart,
            ];
        });
    
        return [
            'subcategory_id' => $sub->id,
            'price'          => (float) $sub->$priceColumn,
            'items'          => $itemsData,
        ];
    })
    ->filter()
    ->values();
        
    return response()->json([
        'status' => 'success',
        'data'   => $responseData,
    ]);
    
}   

  
   /*
    $responseData = $filtered->map(function ($sub) use ($priceColumn) {
        // Get all active items linked to the subcategory by sc_id
        $items = \App\Models\Item::where('sc_id', $sub->id)
            ->where('status', 'Active')
            ->select('code', 'i_logo') // Only return needed fields
            ->get()
            ->map(function ($item) {
                return [
                    'code'   => $item->code,
                    'i_logo' => $item->i_logo,
                ];
            });
   // dd($items);
        return [
            'id'        => $sub->id,
            'price'     => (float) $sub->$priceColumn,
            'sc_video'  => $sub->sc_video,
            'items'     => $items,
        ];
    });

    return response()->json([
        'status' => 'success',
        'data'   => $responseData->values(),
    ]);
    
 */
   
    


//color based
/*
public function color_list(Request $request)
{
    // Step 1: Validate request
    $validator = Validator::make($request->all(), [
        'product_id'  => 'required|exists:product,id',
        'customer_id' => 'required|exists:customers,id',
        'color_id'    => 'required|exists:color,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'error',
            'message' => implode(', ', $validator->errors()->all()),
        ], 422);
    }

    // Step 2: Get customer
    $customer = Customer::where('status', 'Active')
        ->where('id', $request->customer_id)
        ->select('id', 'c_type')
        ->first();

    if (!$customer) {
        return response()->json([
            'status' => 'error',
            'message' => 'Customer not found or inactive.',
        ], 404);
    }

    // Step 3: Determine price column
    $priceColumn = match ($customer->c_type) {
        'A' => 'cat_a',
        'B' => 'cat_b',
        'C' => 'cat_c',
        'D' => 'cat_d',
        'E' => 'cat_e',
        default => null,
    };

    if (!$priceColumn) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid customer type.',
        ], 400);
    }

    // Step 4: Get subcategories
    $subcategories = Subcategory::where('status', 'Active')
        ->where('p_id', $request->product_id)
        ->select('id', $priceColumn, 'sc_video')
        ->get();

    // Step 5: Attach items filtered by color_id
    $responseData = $subcategories->map(function ($sub) use ($priceColumn, $request) {
        $items = Item::where('sc_id', $sub->id)
            ->where('status', 'Active')
            ->where('i_color', $request->color_id)
            ->select('code', 'i_logo')
            ->get()
            ->map(function ($item) {
                return [
                    'code'   => $item->code,
                    'i_logo' => $item->i_logo,
                ];
            });

        return [
            'id'        => $sub->id,
            'price'     => (float) $sub->$priceColumn,
            'sc_video'  => $sub->sc_video,
            'items'     => $items,
        ];
    });

    // Step 6: Return response
    return response()->json([
        'status' => 'success',
        'data'   => $responseData->values(),
    ]);
}
*/

//color list

public function color_filter(Request $request)
{
    // Step 1: Validate request
    $validator = Validator::make($request->all(), [
        'product_id'  => 'required|exists:product,id',
        'customer_id' => 'required|exists:customers,id',
        // 'color_id'    => 'required|exists:color,id',
        'color_id'    => 'required|array',
        'color_id.*'  => 'exists:color,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status'  => 'error',
            'message' => implode(', ', $validator->errors()->all()),
        ], 422);
    }

    // Step 2: Get customer
    $customer = Customer::where('status', 'Active')
        ->where('id', $request->customer_id)
        ->select('id', 'c_type')
        ->first();

    if (!$customer) {
        return response()->json([
            'status' => 'error',
            'message' => 'Customer not found or inactive.',
        ], 404);
    }

    // Step 3: Determine price column
    $priceColumn = match ($customer->c_type) {
        'A' => 'cat_a',
        'B' => 'cat_b',
        'C' => 'cat_c',
        'D' => 'cat_d',
        'E' => 'cat_e',
        default => null,
    };

    if (!$priceColumn) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid customer type.',
        ], 400);
    }

    // Step 4: Get subcategories
    $subcategories = Subcategory::where('status', 'Active')
        ->where('p_id', $request->product_id)
        ->select('id as subcategory_id', $priceColumn, 'sc_video')
        ->get();

    // Step 5: Map and filter only subcategories that have items matching color_id
$responseData = $subcategories->map(function ($sub) use ($priceColumn, $request) {
    $items = Item::where('sc_id', $sub->id)
        ->where('status', 'Active')
        ->whereIn('i_color', $request->color_id)  // ✅ Accept multiple colors
        ->select('code', 'i_logo','i_color','id as item_id')
        ->get()
        ->map(function ($item) {
            return [
                'item_id'   => $item->item_id,
                'code'      => $item->code,
                'i_logo'    => $item->i_logo,
                'color_id'  => $item->i_color,
            ];
        });

    if ($items->isEmpty()) {
        return null;
    }

    return [
        'id'        => $sub->id,
        'price'     => (float) $sub->$priceColumn,
        'sc_video'  => $sub->sc_video,
        'items'     => $items,
    ];
})->filter()->values(); // remove nulls and reset keys


    // Step 6: Return response
    return response()->json([
        'status' => 'success',
        'data'   => $responseData->values(), // reset array keys
    ]);
}


//color list
public function color_list(){

    $color_list = Color::where('status', 'Active')
    ->select('id','co_name')
    ->get();

    return response()->json([
        'status' => 'success',
        'message' => 'Color List',
        'color' => $color_list,

    ], 200);


}




}
