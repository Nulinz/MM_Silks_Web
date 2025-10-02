<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';

    protected $fillable = [
        'c_name', 'status'
    ];

    public function product()
  {
    return $this->belongsTo(Product::class, 'p_id');
  }
  public function subcategories()
  {
    return $this->hasMany(Subcategory::class, 'c_id');
  }

  

}
