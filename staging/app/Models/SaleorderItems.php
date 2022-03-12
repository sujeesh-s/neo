<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleorderItems extends Model
{
    use HasFactory;
    protected $table = 'sales_order_items';
    protected $guarded=[];
    public function product(){ return $this->belongsTo(Product::class, 'prd_id'); }
}
