<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;


class AdminController extends Controller
{
    //
    public function login(Request $request)
    {
        
        $contact = $request->input('contact');
        $password = $request->input('password');

        $user = Admin::where('contact', $contact)->first();

         if (!empty($user)) {
           
 
             if ($password == $user->password) {
                 //dd('Password matched');

               Auth::guard('web')->login($user);
               //dd(auth());

            //    $request->session()->regenerate(); // Prevent session fixation

                
                 return redirect()->route('dashboard.index');
             }
             else {
                 return redirect()->route('login');
             }
         }
         else {
             return redirect()->route('login');
         }
        }
    //admin view page    
    public function admin_list(){

        $admin_list = Admin::all();
        return view('admin.list',compact('admin_list'));
    }
    //user store
    public function admin_store(Request $req)
    {
        //dd($req->all());

        $p_insert =  DB::table('admin')->insert([
            'name'=>$req->name,
            'contact'=>$req->contact,
            'password'=>$req->password,
            'role'=>$req->role,
            'status'=>'Active', 
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
       
        if($p_insert){
            return back();
        }
    }

    //admin status update

    public function admin_status_update(Request $req)
    {
     //dd($req->all());
      $req->validate([
          'id' => 'required|integer|exists:admin,id',
          'status' => 'required|string',
          //'odr_id' => 'required|string',
         
      ]);
      
      $updateData = [
          'status' => $req->status];
 
      $sub_status_update = DB::table('admin')->where('id', $req->id)->update($updateData);
   }
    
   //logout

   public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // Correct guard
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('login');
    }
}
