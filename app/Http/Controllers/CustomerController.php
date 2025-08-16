<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


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

       

         if ($req->cus_id) {
           

            $permission_time = $req->cus_permission_type === 'fullaccess'
            ? Carbon::now()->setTimezone('Asia/Kolkata')->addYears(5)->toDateString()
            : $req->cus_permission_time;
            
    
            $updateData = [
                'c_name'=>$req->cus_name,
                'c_contact'=>$req->cus_contact,
                'c_location'=>$req->cus_location,
                'c_type'=>$req->cus_type,
                'permission_type'=>$req->cus_permission_type,
                'permission_time'=>$permission_time,
                'joindate'=>$req->cus_join_date,
                'cby'=>$req->cus_created_by,
                
            ];
    
           
            $customer_update = DB::table('customers')->where('id', $req->cus_id)->update($updateData);
    
            if ($customer_update) {

                $c_list = DB::table('customers')
                ->where('id', $req->cus_id)
                ->first();
                return view('customer.profile',['c_list'=>$c_list]);
                //return back()->with('message', 'customer updated successfully');
            }
            else {
                return back()->with('info', 'No changs made to the customer');
            }
        }

        

         //dd($permission_time);
        
       else{

                $permission_time = $req->c_permission_type === 'fullaccess'
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
                'device_token' => "",
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        
            if($p_insert){
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
          'status' => $req->status];
 
      $sub_status_update = DB::table('customers')->where('id', $req->id)->update($updateData);
   }

   public function customer_profile(Request $req)
    {
        //dd($req->id);
        //$req->id;

       //dd($req->id);
       // $req->id;

        $c_list = DB::table('customers')
        ->where('id', $req->id)
        ->first();
    
        //return view('employee.profile',['e_list'=>$e_list]);
    


        // $e_list =  DB::table('employee as e')->where('e.id',$req->id)
        // ->leftJoin('employee_salary as es', 'es.e_id','=','e.id')
        // ->select('e.*','es.*','e.id as employee_id','e.e_id as employee_code')
        // ->first();,['e_list'=>$e_list]

        return view('customer.profile',['c_list'=>$c_list]);
    }
    

    //employee edit basic details
    public function customer_edit_basic($id)
    {
       // dd($id);
        $customer_details =  DB::table('customers as c')->where('c.id',$id)->first();

       
        return view('customer.edit_basic',['customer_data'=>$customer_details]);
    }
    


}
