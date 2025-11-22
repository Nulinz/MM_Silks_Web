<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Subcategory;
use App\Models\Item;
use App\Models\Color;

class EditController extends Controller
{
    //
    public function edit_product(Request $req)
    
    {
        //dd($req->id);
         $product_details =  DB::table('product')->where('id',$req->id)->first(); 
         return response()->json($product_details,200);
    }

    public function edit_category(Request $req)
    
    {
        //dd($req->id);
        // $subcategory_details = DB::table('subcat as s')
        // ->leftJoin('category as c', 's.c_id', '=', 'c.id') 
        //  ->where('s.id', $req->id)
        //  ->select('s.*', 'c.id as category_id', 'c.c_name as category_name','s.id as subcategory_id')
        // ->first();

        $category_details = DB::table('category as c')
        ->leftJoin('product as p', 'p.id', '=', 'c.p_id') 
         ->where('c.id', $req->id)
         ->select('c.*', 'c.id as category_id', 'p.p_name as product_name','p.id as product_id','c.c_logo')
        ->first();

        // $category_details =  DB::table('category as c')->where('c.id',$req->id)->first(); 
        return response()->json($category_details,200);
    }

    public function edit_subcategory(Request $req)
    
    {
       

        $subcategory_details = DB::table('subcategory as s')
        ->leftJoin('product as p', 'p.id', '=', 's.p_id') 
        ->leftJoin('category as c', 'c.id', '=', 's.c_id') 
         ->where('s.id', $req->id)
         ->select('s.*','s.id as subcategory_id','s.sc_name as subcategory_name', 'p.p_name as product_name','p.id as product_id','c.c_name as category_name','c.id as category_id','s.sc_logo')
        ->first();

        // $category_details =  DB::table('category as c')->where('c.id',$req->id)->first(); 
        return response()->json($subcategory_details,200);
    }


    public function edit_items(Request $req)
    
    {
        //dd($req->id);
        // $subcategory_details = DB::table('subcat as s')
        // ->leftJoin('category as c', 's.c_id', '=', 'c.id') 
        //  ->where('s.id', $req->id)
        //  ->select('s.*', 'c.id as category_id', 'c.c_name as category_name','s.id as subcategory_id')
        // ->first();

        $subcategory_details = DB::table('items as i')
        ->leftJoin('subcategory as s', 's.id', '=', 'i.sc_id')
        ->leftJoin('color as c', 'c.id', '=', 'i.i_color')  
         ->where('i.id', $req->id)
         ->select('i.*', 'i.id as item_id', 's.sc_name as subcategory_name','s.id as subcategory_id','i.i_logo','i.code','c.id as color_id','c.co_name as color_name')
        ->first();

        // $category_details =  DB::table('category as c')->where('c.id',$req->id)->first(); 
        return response()->json($subcategory_details,200);
    }

    public function edit_color(Request $req)
    
    {
        //dd($req->id);
         $color_details =  DB::table('color')->where('id',$req->id)->first(); 
         return response()->json($color_details,200);
    }

    public function delete_category($id)
    {
         $category = Category::find($id);
 
         if (!$category) {
             return response()->json([
                 'status' => 'error',
                 'message' => 'Customer not found.',
             ], 404);
         }
 
         $category->delete();
 
         return back();
   }
   public function delete_subcategory(Request $request,$id)
   {
        $subcategory = Subcategory::find($id);

        if (!$subcategory) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer not found.',
            ], 404);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully.',
            ]);
        }
    

        $subcategory->delete();

        return back();
   }
   public function delete_items($id)
   {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer not found.',
            ], 404);
        }

        $item->delete();

        return back();
    }

    public function delete_colors($id)
    {
         $color = Color::find($id);
 
         if (!$color) {
             return response()->json([
                 'status' => 'error',
                 'message' => 'Customer not found.',
             ], 404);
         }
 
         $color->delete();
 
         return back();
     }

     public function deleteMultiple(Request $request)
     {
         $ids = $request->ids;
         if(!empty($ids)) {
             Item::whereIn('id', $ids)->delete();
             return response()->json(['message' => 'Items deleted successfully']);
         }
         return response()->json(['message' => 'No items selected'], 400);
     }
     
     public function getSubcategories($id) {
        $subcategories = Subcategory::where('c_id', $id)->with('item','product','category')->get();
    
        $html = '';
        foreach($subcategories as $key => $sub) {
            $itemCount = count($sub->item);

            $html .= '<tr>';
            $html .= '<td>'.($key+1).'</td>';
            $html .= '<td>'.$sub->product->p_name.'</td>';
            $html .= '<td>'.$sub->category->c_name.'</td>';
            $html .= '<td>'.$sub->sc_name.'</td>';
            $html .= '<td>'.$sub->cat_a.'</td>';
            $html .= '<td>'.$sub->cat_b.'</td>';
            $html .= '<td>'.$sub->cat_c.'</td>';
            $html .= '<td><img src="'.asset("image/subcatimage/".$sub->sc_logo).'" height="30"></td>';
            $html .= '<td>' . count($sub->item) . '</td>';
           
            // LIST LINK (no Blade syntax)
            if ($itemCount > 0) {
                $html .= '<td>
                            <a href="#" class="view_subitems" data-subcategory="' . $sub->id . '">List</a>
                          </td>';
            } else {
                $html .= '<td>No Items</td>';
            }        //     <td>
        //     @if($category->subcategories->count() > 0)
        //         <span class="badge bg-info">{{ $total_items }} Items</span><br>
        //         <a href="#" class="view_subcategories" data-category="{{ $category->id }}">List</a>
        //     @else
        //         No Subcategories
        //     @endif
        // </td>

            $html .= '<td>'.$sub->status.'</td>';
    
            // Action Buttons (Edit + Delete)
            // $html .= '<td style="display:flex; gap:10px; align-items:center;">';
    
            // // EDIT BUTTON
            // $html .= '<a data-bs-toggle="modal" data-bs-target="#editsubcategory">
            //             <i class="fas fa-pen-to-square edit_sub_button" 
            //                 style="color:black; cursor:pointer;" 
            //                 data-id="'.$sub->id.'"></i>
            //           </a>';
    
            // // DELETE BUTTON
            // $html .= '<button class="delete-subcategory-btn" data-id="'.$sub->id.'" 
            //                 style="background:none; border:none; cursor:pointer;">
            //                 <i class="fas fa-trash-alt" style="color:black;"></i>
            //           </button>';
    
            // $html .= '</td>';
            $html .= '</tr>';
        }
    
        return $html;
    }
    
    public function delete_subcategory_details(Request $request,$id)
   {
        $subcategory = Subcategory::find($id);

        if (!$subcategory) {
            return response()->json([
                'status' => 'error',
                'message' => 'Customer not found.',
            ], 404);
        }

        $subcategory->delete();

        return back();
   }


  

    public function getSubItems($id)
{
    $items = Item::with('subcategory')->where('sc_id', $id)->get();

    $html = '';

    foreach ($items as $key => $item) {

        $html .= '<tr>';
        $html .= '<td>' . ($key + 1) . '</td>';
        $html .= '<td><input type="checkbox" class="select_item" value="' . $item->id . '"></td>';
        $html .= '<td>' . $item->subcategory->sc_name . '</td>';
        $html .= '<td>' . $item->code . '</td>';
        $html .= '<td><img src="' . asset("image/itemimage/" . $item->i_logo) . '" height="30"></td>';
        $html .= '<td>' . $item->status . '</td>';
        $html .= '</tr>';
    }

    return $html;
}
public function subitem_deleteMultiple(Request $request)
{
    $ids = $request->ids;
    if(!empty($ids)) {
        Item::whereIn('id', $ids)->delete();
        return response()->json(['message' => 'Items deleted successfully']);
    }
    return response()->json(['message' => 'No items selected'], 400);
}



}
