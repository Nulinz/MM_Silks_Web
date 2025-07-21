<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';

    protected $fillable = [
        'sc_id','','sc_name','code','i_logo', 'status'
    ];
  
    public function subcategory()
    {
      return $this->belongsTo(Subcategory::class, 'sc_id');
    }
}
