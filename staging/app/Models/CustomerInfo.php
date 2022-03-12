<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerInfo extends Model
{
    use HasFactory;
    protected $table = 'usr_info';
    protected $fillable = ['org_id','user_id', 'usr_role_id', 'first_name','middle_name','last_name','address','pincode','country_id','state_id','city_id','profile_image','is_active','is_deleted','created_by','updated_by','created_at','updated_at'];

    public function country(){ return $this->belongsTo(Country ::class, 'country_id'); }
    public function state(){ return $this->belongsTo(State ::class, 'state_id'); }
    public function city(){ return $this->belongsTo(City ::class, 'city_id'); }
    
}
