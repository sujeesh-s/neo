<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'usr_cart_item';
    protected $fillable = ['org_id','cart_id','product_id','quantity','is_active','is_deleted','created_by','updated_by','created_at','updated_at'];
}
