<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Item;
use App\Models\Color;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;



class CreateController extends Controller
{
    //view product list
    public function product_list(){
        $product_list = Product::withCount(['categories', 'subcategories'])->get();

        return view('create.product.product',compact('product_list'));
    }
    //view category list
    public function category_list(){
        $category_list = Category::with(['product', 'subcategories'])->get();
        //$category_list = Category::with('product')->get();  
       
         
        //$product_list = Product::all();
        $product_list = Product::where('status', 'Active')->get();


        return view('create.category.category', compact('product_list', 'category_list'));

    }

    //view subcategory list
    public function subcategory_list(){

        $subcategory_list = Subcategory::with(['product', 'category','item'])->get();

        $product_list = Product::where('status', 'Active')->get();
        $category_list = Category::where('status', 'Active')->get();

        //$product_list = Product::all();
        //$category_list = Category::all();

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
         $color_list = Color::where('status', 'Active')->get();

        $subcategory_list = Subcategory::where('status', 'Active')->get();
        return view('create.items.items',compact('subcategory_list','item_list','color_list'));
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
        $videoname = null;
    
        // Update
        if ($req->subcategory_id) {

            $existing = DB::table('subcategory')->where('id', $req->subcategory_id)->first();
    
            // Handle logo if uploaded
            if ($req->hasFile('subcategory_logo')) {
                $image = $req->file('subcategory_logo');
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('image/subcatimage'), $filename);
            }

            
            if ($req->hasFile('subcategory_video')) {
                // Delete old video file if exists
                if ($existing->sc_video && file_exists(public_path('image/subcatvideos/' . $existing->sc_video))) {
                    unlink(public_path('image/subcatvideos/' . $existing->sc_video));
                }
    
                $video = $req->file('subcategory_video');
                $videoname = time() . '_' . $video->getClientOriginalName();
                $video->move(public_path('image/subcatvideos'), $videoname);
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

            if ($videoname) {
                $updateData['sc_video'] = $videoname;
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
    

           
            $req->validate([
                'sc_video' => 'nullable|mimes:mp4,mov,avi,wmv|max:51200', // Max 50MB
            ]);

            if ($req->hasFile('sc_video')) {
                $video = $req->file('sc_video');
                $videoname = time() . '_' . $video->getClientOriginalName();
                $video->move(public_path('image/subcatvideos'), $videoname);
            }
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

            if ($videoname) {
                $insertData['sc_video'] = $videoname ?? '';
            }
            
    
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
         //dd($req->all());
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
                'i_color'=>$req->item_color,
                'types'=>$req->item_types,
                
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

                $barcode = $req->i_code;
                $newType = $req->types;

             // Check if barcode already exists
                $item = DB::table('items')->where('code', $barcode)->first();

             if (!$item) {
                    // return redirect()->back()->with('message', 'Barcode already exists!');
                

                    $filename = null;
                
                    if ($req->hasFile('i_logo')) {
                        $image = $req->file('i_logo');
                        $filename = time() . '_' . $image->getClientOriginalName();
                        $image->move(public_path('image/itemimage'), $filename);
                    } 

                    else if ($req->i_logo && strpos($req->i_logo, 'data:image') === 0) 
                    {
                          $imageData = $req->i_logo;
                
                        $image_parts = explode(";base64,", $imageData);
                        if (count($image_parts) == 2) {
                            $mime_type = $image_parts[0];
                            $image_base64 = base64_decode($image_parts[1]);
                
                            // Detect file extension
                            if (strpos($mime_type, 'jpeg') !== false) {
                                $extension = 'jpg';
                            } else if (strpos($mime_type, 'png') !== false) {
                                $extension = 'png';
                            } else {
                                return back()->with('error', 'Unsupported image format');
                            }
        
                            $filename = time() . '.' . $extension;
                            file_put_contents(public_path('image/itemimage/') . $filename, $image_base64);
                        } else {
                            return back()->with('error', 'Invalid base64 image data');
                        }
                   } 
    
                    
                    else {
                        return back()->with('error', 'Please upload an item image');
                    }

                    $c_insert =  DB::table('items')->insert([
                        'sc_id'=>$req->sub_id,
                        'code'=>$barcode,
                        'i_color'=>$req->color,
                        'types'=>$req->types,
                        'i_logo'=>$filename,
                        'status'=>'Active', 
                        'created_at'=>now(),
                        'updated_at'=>now()
                    ]);
        
                    if($c_insert){
                        return back();
                    }
               }
               else {
                // Barcode exists
                    if ($item->types === 'ready') {
                        return redirect()->back()->with('message', 'Barcode already exists!');
                    }

                   
                    if ($newType === 'ready') {
                        // Prepare image if needed
                        $filename = $item->i_logo; // default to existing

                        if ($req->hasFile('i_logo')) {
                            $image = $req->file('i_logo');
                            $filename = time() . '_' . $image->getClientOriginalName();
                            $image->move(public_path('image/itemimage'), $filename);
                        } else if ($req->i_logo && strpos($req->i_logo, 'data:image') === 0) {
                            $imageData = $req->i_logo;

                                $image_parts = explode(";base64,", $imageData);
                                if (count($image_parts) == 2) {
                                    $mime_type = $image_parts[0];
                                    $image_base64 = base64_decode($image_parts[1]);

                                    if (strpos($mime_type, 'jpeg') !== false) {
                                        $extension = 'jpg';
                                    } else if (strpos($mime_type, 'png') !== false) {
                                        $extension = 'png';
                                    } else {
                                        return back()->with('error', 'Unsupported image format');
                                    }

                                    $filename = time() . '.' . $extension;
                                    file_put_contents(public_path('image/itemimage/') . $filename, $image_base64);
                                } else {
                                    return back()->with('error', 'Invalid base64 image data');
                                }
                        }

            // Update all fields now
                                DB::table('items')->where('code', $barcode)->update([
                                    'sc_id'      => $req->sub_id,
                                    'i_color'    => $req->color,
                                    'types'      => $newType,
                                    'i_logo'     => $filename,
                                    'status'     => 'Active',
                                    'updated_at' => now()
                                ]);

                                return redirect()->back()->with('message', 'Item updated to finished.');
                    }
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
        ->where('category.status', '=', 'Active')
        ->get(['id', 'c_name']);

    return response()->json($categories);
 }

   
//color list

public function color_list(){
    $color_list = Color::all();

    return view('create.color.color',compact('color_list'));
}


//colore store

 //product store
 public function colors_store(Request $req)
 {
     //update data
    if($req->color_id){

         $updateData = [
             'co_name' => $req->color_name,
             
         ];
         $color_update = DB::table('color')->where('id', $req->color_id)->update($updateData);
             if($color_update){
                 return back()->with('message','product update sucessfully');
             }
             else {
                 return back()->with('info', 'No changes made to the item');
             }

    }

    //insert data
    else{
         $co_insert =  DB::table('color')->insert([
             'co_name'=>$req->co_name,
             'status'=>'Active', 
             'created_at'=>now(),
             'updated_at'=>now()
         ]);

         if($co_insert){
             return back();
         }
         
    }
     
 }

 public function subcategory_wise_list(){
    //$subcategory_droplist = Subcategory::all();
    $subcategory_droplist = Subcategory::where('status', 'Active')->get();

    return view('subcategory_wise.subcategory_wise',compact('subcategory_droplist'));
}


public function item_details_list(Request $req){
    // $color_list = Color::all();
    

    //dd($req->all());

    $id = $req->query('id');  

    $subcategory = DB::table('subcategory')
    ->where('id','=', $req->id)
    ->select('id', 'sc_name')
    ->first();
    //$color_list = Color::all();
    $color_list = Color::where('status', 'Active')->get();


    return view('subcategory_wise.item_details',compact('color_list','subcategory','id'));
}


//color status update
public function color_status_update(Request $req)
{
  //dd($req->all());
    $req->validate([
        'id' => 'required|integer|exists:color,id',
        'status' => 'required|string',
        //'odr_id' => 'required|string',
       
    ]);
    
    $updateData = [
        'status' => $req->status];

    $sub_status_update = DB::table('color')->where('id', $req->id)->update($updateData);
}


    public function reduce_list()
    {
        //$customer_list = Customer::all();
        return view('reduce.list');
    }

//color status update
public function reduce_items(Request $request)
{
    Log::info($request->all());

    $request->validate([
        'csv_file' => 'required|mimes:csv,txt',
    ]);

    if (($handle = fopen($request->file('csv_file')->getRealPath(), 'r')) !== false) {

        $header = fgetcsv($handle, 1000, ',');

        // REMOVE BOM + spaces
        $header = array_map('trim', $header);
        $header = array_map(function($h){
            return preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $h);
        }, $header);

        Log::info("Clean Header:", $header);

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {

            if (count(array_filter($row)) == 0) continue;

            // Fix row size mismatch
            if (count($row) < count($header)) {
                $row = array_pad($row, count($header), null);
            }

            $data = array_combine($header, $row);

            $code = trim($data['code'] ?? '');

            if ($code === '') {
                Log::warning("Skipping row - missing code");
                continue;
            }

            DB::table('items')
                ->where('code', $code)
                ->update(['status' => 'inactive']);
        }

        fclose($handle);
    }

    return redirect()->back()->with('success', 'CSV uploaded and items updated successfully!');

   }








   //dee
 

 // For AJAX preview
    public function get_reduce_items(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

       // Log::info($request->all());
        $file = $request->file('csv_file');

        $csvData = array_map('str_getcsv', file($file->getRealPath()));
        if (!$csvData || count($csvData) < 1) {
            return response('<p class="text-center">CSV file is empty or invalid.</p>');
        }

        // Use first row as header
        $header = array_map(function($h) {
            return strtolower(trim(str_replace("\xEF\xBB\xBF", '', $h)));
        }, $csvData[0]);
        unset($csvData[0]);
        
        $matchedItems = [];
        $maxLength = Item::selectRaw('MAX(LENGTH(code)) as length')->value('length');

        foreach ($csvData as $row) {
            $data = array_combine($header, $row);
            if (!empty($data['code'])) {
                $csvCode = trim($data['code']);
                $item = Item::where('code', $csvCode)
                ->orWhere('code', str_pad($csvCode, 4, '0', STR_PAD_LEFT))
                ->orWhere('code', str_pad($csvCode, 3, '0', STR_PAD_LEFT))
                ->first();
// or use LOWER() for case-insensitive
                if ($item) {
                    $matchedItems[$item->id] = $item;
                }
            }
        }
        
        // Return HTML table as response
        if (count($matchedItems) > 0) {
            $html = '<table class="example table table-bordered">
                        <thead>
                            <tr  data-id="{{ $item->id }}">
                                <th>#</th>
                                <th>Code</th>
                              
                               
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($matchedItems as $key => $item) {
                $imagePath = $item->i_logo 
                ? asset('image/itemimage/' . $item->i_logo) 
                : asset('image/default.png'); // fallback image if no logo
            

                $html .= '<tr data-id="' . $item->id . '">
                            <td>' . ($key + 1) . '</td>
                            <td>' . $item->code . '</td>
                            
                           
                          </tr>';
            }
            $html .= '</tbody></table>';
        } else {
            $html = '<p class="text-center">No matching items found in database.</p>';
        }

        return response($html);
    }

} 



