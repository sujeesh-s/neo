<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentSale extends Model
{
    use HasFactory;
    protected $table = 'sale_order_parent';
    protected $fillable = ['org_id','user_id', 'tot_amount', 'platform_coupon_id','discount_type','discount_amt','wallet_amt','grand_total','created_at','updated_at'];
}
