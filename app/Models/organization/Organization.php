<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Organization extends Model
{
    use HasFactory;
    protected $table = 'organization';
    protected $guarded = [];  
   
}
