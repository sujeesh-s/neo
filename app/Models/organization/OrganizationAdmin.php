<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class OrganizationAdmin extends Model
{
    use HasFactory;
    protected $table = 'org_admin';
    protected $guarded = [];  
   
}
