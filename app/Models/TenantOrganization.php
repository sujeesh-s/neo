<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class TenantOrganization extends Model
{
    use HasFactory;
    protected $table = 'tenant_organization';
    protected $guarded = [];  
   
}
