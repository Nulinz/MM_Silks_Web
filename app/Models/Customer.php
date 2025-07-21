<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    protected $fillable = [
        'c_name', 'c_contact','c_location','c_type','permission_type','permission_time','cby','status','device_token'
    ];
}
