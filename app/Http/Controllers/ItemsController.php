<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemsController extends Controller
{
    //
    public function item_list(){
        return view('items.items');
    }
}
