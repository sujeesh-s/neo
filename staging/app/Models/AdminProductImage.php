<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProductImage extends Model
{
    use HasFactory;
    protected $table = 'prd_admin_images';
    protected $guarded=[];
}
