<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Color;


class CustomerController extends Controller
{
    //
    public function Customer_list()
    {
        $customer_list = Customer::all();
        return view('customer.list', compact('customer_list'));
    }

    public function customer_create_basic()
    {
        return view('customer.create_basic');
    }


    //customer store
    //user store
    public function customer_store(Request $req)
    {
        // dd($req->c_permission_time);



        if ($req->cus_id) {


            if ($req->cus_permission_type === 'fullaccess') {
                // 5 years from now
                $permission_time = Carbon::now()
                    ->setTimezone('Asia/Kolkata')
                    ->addYears(5)
                    ->toDateString();
            } elseif ($req->cus_permission_type === 'onetime') {
                // Current date
                $permission_time = Carbon::now()
                    ->setTimezone('Asia/Kolkata')
                    ->toDateString();
            }


            $updateData = [
                'c_name' => $req->cus_name,
                'c_contact' => $req->cus_contact,
                'c_location' => $req->cus_location,
                'c_type' => $req->cus_type,
                'permission_type' => $req->cus_permission_type,
                'permission_time' => $permission_time,
                // 'joindate' => $req->cus_join_date,
                'cby' => $req->cus_created_by,

            ];


            $customer_update = DB::table('customers')->where('id', $req->cus_id)->update($updateData);

            if ($customer_update) {

                $c_list = DB::table('customers')
                    ->get();
                    //return back();
                return view('customer.list', ['customer_list' => $c_list]);
                //return back()->with('message', 'customer updated successfully');
            } else {
                $c_list = DB::table('customers')
                ->get();
                return view('customer.list', ['customer_list' => $c_list]);
            }
        }



        //dd($permission_time);

        else {

            $permission_time = $req->c_permission_type === 'fullaccess'
                ? Carbon::now()->setTimezone('Asia/Kolkata')->addYears(5)->toDateString()
                : $req->c_permission_time;

            $p_insert =  DB::table('customers')->insert([
                'c_name' => $req->c_name,
                'c_contact' => $req->c_contact,
                'c_location' => $req->c_location,
                'c_type' => $req->c_type,
                'permission_type' => $req->c_permission_type,
                'permission_time' => $permission_time,
                'joindate' => $req->c_join_date,
                'cby' => $req->created_by,
                'status' => 'Active',
                'device_token' => "",
                'created_at' => now(),
                'updated_at' => now()
            ]);

            if ($p_insert) {
                return back();
            }
        }
    }

    public function customer_status_update(Request $req)
    {
        //dd($req->all());
        $req->validate([
            'id' => 'required|integer|exists:customers,id',
            'status' => 'required|string',
            //'odr_id' => 'required|string',

        ]);

        $updateData = [
            'status' => $req->status
        ];

        $sub_status_update = DB::table('customers')->where('id', $req->id)->update($updateData);
    }

    public function customer_profile(Request $req)
    {
        //dd($req->id);
        //$req->id;

       
        $c_list = DB::table('customers')
            ->where('id', $req->id)
            ->first();

        return view('customer.profile', ['c_list' => $c_list]);
    }


    //employee edit basic details
    public function customer_edit_basic($id)
    {
        // dd($id);
        $customer_details =  DB::table('customers as c')->where('c.id', $id)->first();


        return view('customer.edit_basic', ['customer_data' => $customer_details]);
    }

    //customer_wise report

    public function customer_wise_list()
    {
        //$subcategory_droplist = Subcategory::all();
        $customer_droplist = Customer::where('status', 'Active')->get();

        return view('sales.customer_drop_list', compact('customer_droplist'));
    }

    //
    public function customer_details_list(Request $req)
    {
        // $color_list = Color::all();


        //dd($req->all());

        $id = $req->query('id');

        $customer = DB::table('customers')
            ->where('id', '=', $req->id)
            ->select('id', 'c_name')
            ->first();
        //$color_list = Color::all();
        $color_list = Color::where('status', 'Active')->get();
        'color_list';


        return view('sales.customer_sales', compact('customer', 'color_list'));
        
    }

    //check phone no exit
    public function checkPhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|numeric'
        ]);
        $exists = Customer::where('c_contact', $request->phone)->exists();
        return response()->json(['exists' => $exists]);
    }

    public function delete_customer($id)
   {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer not found.',
            ], 404);
        }

        $customer->delete();

        return back();
  }

  public function check_edit_number(Request $request)
  {
   // dd($request->all());
    $request->validate([
        'phone' => 'required|numeric',
    ]);

    // If editing, pass current customer ID from frontend (optional)
    $customerId = $request->input('id'); 

    $query = Customer::where('c_contact', $request->phone);

    // Exclude the current record if editing
    if ($customerId) {
        $query->where('id', '!=', $customerId);
    }

    $exists = $query->exists();

    return response()->json(['exists' => $exists]);
  }


}
