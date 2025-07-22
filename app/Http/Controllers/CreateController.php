<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Item;
use Illuminate\Support\Facades\Log;


class CreateController extends Controller
{
    //view product list
    public function product_list(){
        $product_list = Product::all();

        return view('create.product.product',compact('product_list'));
    }
    //view category list
    public function category_list(){
        $category_list = Category::with('product')->get();  
       // dd($category_list->pluck('c_name'));
         
       // $product_list = Product::all();
        $product_list = Product::where('status', 'Active')->get();


        return view('create.category.category',compact('product_list'),compact('category_list'));
    }

    //view subcategory list
    public function subcategory_list(){

        $subcategory_list = Subcategory::with(['product', 'category'])->get();

        $product_list = Product::where('status', 'Active')->get();
        $category_list = Category::where('status', 'Active')->get();

       // $product_list = Product::all();
       // $category_list = Category::all();

        return view('create.subcategory.subcategory', compact('product_list', 'category_list', 'subcategory_list'));
}
    

    //view item list
    public function item_list(){

        // $i_list = DB::table('items as i')
        // ->leftJoin('subcategory as sc', 'sc.id','=','i.sc_id')
        // ->select('i.status as item_status','i.*','sc.*')
        // ->get();
        //dd($i_list);
        //dd($i_list);
        $product_list = Product::where('status', 'Active')->get();

        $item_list = Item::with(['subcategory'])->get();
       // dd( $item_list);
        //dd($item_list->pluck('sc_id', 'id'));
       // dd($item_list->pluck('subcategory.sc_name'));

        $subcategory_list = Subcategory::where('status', 'Active')->get();
        return view('create.items.items',compact('subcategory_list','item_list'));
    }

    //product store
    public function product_store(Request $req)
    {
        //update data
       if($req->product_id){

            $updateData = [
                'p_name' => $req->product_name,
                
            ];
            $product_update = DB::table('product')->where('id', $req->product_id)->update($updateData);
                if($product_update){
                    return back()->with('message','product update sucessfully');
                }
                else {
                    return back()->with('info', 'No changes made to the item');
                }

       }

       //insert data
       else{
            $p_insert =  DB::table('product')->insert([
                'p_name'=>$req->p_name,
                'status'=>'Active', 
                'created_at'=>now(),
                'updated_at'=>now()
            ]);

            if($p_insert){
                return back();
            }
            
       }
        
    }
   
    //category store
    public function category_store(Request $req)
    {
       //dd($req->all());
       $filename = null;

       if($req->category_id){

        if ($req->hasFile('category_logo')) {
            $image = $req->file('category_logo');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('image/catimage'), $filename);
        }


            $updateData = [
                
                'p_id'=>$req->product_drop,
                'c_name' => $req->category_name,
               
            ];
            if ($filename) {
                $updateData['c_logo'] = $filename;
            }
            
            $cat_update = DB::table('category')->where('id', $req->category_id)->update($updateData);
                if($cat_update){
                    return back()->with('message','product update sucessfully');
                }
                else {
                    return back()->with('info', 'No changes made to the item');
                }

        }

        else{
                $image = $req->file('c_logo');
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('image/catimage'), $filename);

                $c_insert =  DB::table('category')->insert([
                    'p_id'=>$req->p_id,
                    'c_name'=>$req->c_name,
                    'c_logo'=>$filename,
                    'status'=>'Active', 
                    'created_at'=>now(),
                    'updated_at'=>now()
                ]);
            
                if($c_insert){
                    return back();
                }
        }
    }

    //subcategory store
    public function subcategory_store(Request $req)
    {
        $filename = null;
    
        // Update
        if ($req->subcategory_id) {
    
            // Handle logo if uploaded
            if ($req->hasFile('subcategory_logo')) {
                $image = $req->file('subcategory_logo');
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('image/subcatimage'), $filename);
            }
    
            $updateData = [
                'p_id'    => $req->product_drop,
                'c_id'    => $req->cat_drop,
                'sc_name' => $req->subcategory_name,
                'cat_a'   => $req->catprice_a,
                'cat_b'   => $req->catprice_b,
                'cat_c'   => $req->catprice_c,
                'cat_d'   => $req->catprice_d,
                'cat_e'   => $req->catprice_e,
            ];
    
            if ($filename) {
                $updateData['sc_logo'] = $filename;
            }
    
            $subcat_update = DB::table('subcategory')->where('id', $req->subcategory_id)->update($updateData);
    
            if ($subcat_update) {
                return back()->with('message', 'Subcategory updated successfully');
            }
            else {
                return back()->with('info', 'No changes made to the item');
            }
        }
    
        // Create
        else {
    
            if ($req->hasFile('sc_logo')) {
                $image = $req->file('sc_logo');
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('image/subcatimage'), $filename);
            }
    
            $insertData = [
                'p_id'       => $req->p_id,
                'c_id'       => $req->c_id,
                'sc_name'    => $req->sc_name,
                'cat_a'      => $req->cat_a,
                'cat_b'      => $req->cat_b,
                'cat_c'      => $req->cat_c,
                'cat_d'      => $req->cat_d,
                'cat_e'      => $req->cat_e,
                'status'     => 'Active',
                'created_at' => now(),
                'updated_at' => now()
            ];
    
            if ($filename) {
                $insertData['sc_logo'] = $filename;
            }
    
            $sc_insert = DB::table('subcategory')->insert($insertData);
    
            if ($sc_insert) {
                return back()->with('message', 'Subcategory added successfully');
            }
        }
    
        return back()->with('error', 'Something went wrong.');
    }
    

    //items store
    //category store
    public function items_store(Request $req)
    {

        if ($req->item_id) {
            $filename = null;
    
            // Handle logo if uploaded
            if ($req->hasFile('item_logo')) {
                $image = $req->file('item_logo');
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('image/itemimage'), $filename);
            }
    
            $updateData = [
                'sc_id'    => $req->subcat_drop,
                'code'    => $req->item_code,
                
            ];
    
            if ($filename) {
                $updateData['i_logo'] = $filename;
            }
    
            $item_update = DB::table('items')->where('id', $req->item_id)->update($updateData);
    
            if ($item_update) {
                return back()->with('message', 'Subcategory updated successfully');
            }
            else {
                return back()->with('info', 'No changes made to the item');
            }
        }


      else{

        $filename = null;
    
        if ($req->hasFile('i_logo')) {
            $image = $req->file('i_logo');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('image/itemimage'), $filename);
        } else {
            return back()->with('error', 'Please upload an item image');
        }

        $c_insert =  DB::table('items')->insert([
            'sc_id'=>$req->sub_id,
            'code'=>$req->i_code,
            'i_logo'=>$filename,
            'status'=>'Active', 
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
       
        if($c_insert){
            return back();
        }
      }
    }
  //product status update

  public function product_status_update(Request $req)
  {
    //dd($req->all());
      $req->validate([
          'id' => 'required|integer|exists:product,id',
          'status' => 'required|string',
          //'odr_id' => 'required|string',
         
      ]);
      
      $updateData = [
          'status' => $req->status];

      $sub_status_update = DB::table('product')->where('id', $req->id)->update($updateData);
 }

 //category status update
 public function category_status_update(Request $req)
 {
   //dd($req->all());
     $req->validate([
         'id' => 'required|integer|exists:category,id',
         'status' => 'required|string',
         //'odr_id' => 'required|string',
        
     ]);
     
     $updateData = [
         'status' => $req->status];

     $sub_status_update = DB::table('category')->where('id', $req->id)->update($updateData);
     }

    public function subcategory_status_update(Request $req)
    {
       //dd($req->all());
         $req->validate([
             'id' => 'required|integer|exists:subcategory,id',
             'status' => 'required|string',
             //'odr_id' => 'required|string',
            
         ]);
         
         $updateData = [
             'status' => $req->status];
    
         $sub_status_update = DB::table('subcategory')->where('id', $req->id)->update($updateData);
    }

    public function item_status_update(Request $req)
   {
    //dd($req->all());
     $req->validate([
         'id' => 'required|integer|exists:items,id',
         'status' => 'required|string',
         //'odr_id' => 'required|string',
        
     ]);
     
     $updateData = [
         'status' => $req->status];

     $sub_status_update = DB::table('items')->where('id', $req->id)->update($updateData);
  }


  public function getCategories(Request $req)
{
    //Log::info('AJAX request received', $req->all());

    // Assuming each category belongs to a product
    $categories = DB::table('category')
        ->where('p_id','=', $req->product_id)
        ->get(['id', 'c_name']);

    return response()->json($categories);
}

   


    


}
