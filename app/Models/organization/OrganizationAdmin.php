<?php

namespace App\Models\Organization;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class OrganizationAdmin extends Authenticatable
{
    use HasFactory;
    protected $table = 'org_admin';
    protected $guarded = [];  
    protected $guard = 'organization';
   
}
