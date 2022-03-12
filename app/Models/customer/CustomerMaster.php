<?php

namespace App\Models\customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\customer\CustomerAddress;
use App\Models\customer\CustomerAddressType;
class CustomerMaster extends Model
{
    use HasFactory;
    protected $table = 'usr_mst';
    protected $fillable = ['org_id','username', 'email', 'phone','ref_code','is_active','is_deleted','created_by','updated_by','created_at','updated_at'];
    public function telecom_ph($user_id){ return CustomerTelecom::where('user_id',$user_id)->where('usr_telecom_typ_id',2)->where('is_active',1)->where('is_deleted',0)->first(); }
    public function telecom_email($user_id){ return CustomerTelecom::where('user_id',$user_id)->where('usr_telecom_typ_id',1)->where('is_active',1)->where('is_deleted',0)->first(); }
    public function user_address($user_id,$default=''){ 
        
    $addr = CustomerAddress::getUserAddress($user_id,$default);
    return $addr;
    }
}
