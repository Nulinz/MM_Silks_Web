<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $table = 'subcategory';

    protected $fillable = [
        'p_id','c_id','sc_name','category_price', 'status','sc_logo','sc_video'
    ];

    public function product()
    {
      return $this->belongsTo(Product::class, 'p_id');
    }
    public function category()
    {
      return $this->belongsTo(Category::class, 'c_id');
    }
    public function item()
  {
    return $this->hasMany(Item::class, 'sc_id');
  }
}
