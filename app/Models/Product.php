<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    protected $fillable = [
        'p_name', 'status'
    ];

    public function categories()
  {
    return $this->hasMany(Category::class, 'p_id');
   }
   public function subcategories()
   {
     return $this->hasMany(Subcategory::class, 'p_id');
    }

    
}
