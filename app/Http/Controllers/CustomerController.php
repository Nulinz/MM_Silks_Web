<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomerController extends Controller
{
    //
    public function Customer_list(){
        $customer_list = Customer::all();
        return view('customer.list',compact('customer_list'));
    }
    
    public function customer_create_basic(){
        return view('customer.create_basic');
    }

    
    //customer store
    //user store
    public function customer_store(Request $req)
    {
        // dd($req->c_permission_time);

       // $permission_time = $req->c_permission_type === 'fullallow'
        // ? Carbon::now()->setTimezone('Asia/Kolkata')->addYears(5)->toDateTimeString()
        // : $req->c_permission_time;

        //dd($permission_time);

        $permission_time = $req->c_permission_type === 'fullallow'
        ? Carbon::now()->setTimezone('Asia/Kolkata')->addYears(5)->toDateString()
        : $req->c_permission_time;


        

        $p_insert =  DB::table('customers')->insert([
            'c_name'=>$req->c_name,
            'c_contact'=>$req->c_contact,
            'c_location'=>$req->c_location,
            'c_type'=>$req->c_type,
            'permission_type'=>$req->c_permission_type,
            'permission_time'=>$permission_time,
            'joindate'=>$req->c_join_date,
            'cby'=>$req->created_by,
            'status'=>'Active', 
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
       
        if($p_insert){
            return back();
        }
    }

    public function customer_status_update(Request $req)
    {
     //dd($req->all());
      $req->validate([
          'id' => 'required|integer|exists:admin,id',
          'status' => 'required|string',
          //'odr_id' => 'required|string',
         
      ]);
      
      $updateData = [
          'status' => $req->status];
 
      $sub_status_update = DB::table('customers')->where('id', $req->id)->update($updateData);
   }
    


}
