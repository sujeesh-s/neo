<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class OrganizationAddress extends Model
{
    use HasFactory;
    protected $table = 'org_address';
    protected $guarded = [];  
   
}
