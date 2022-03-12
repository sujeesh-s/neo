<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use DB;
use App\Models\RewardType;
class SettingOther extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'settings_others';

    protected $fillable = ['org_id', 'refund_deduction', 'return_period','bid_charge','is_active','is_deleted','created_by','updated_by','created_at','updated_at'];

        static function getOtherSettings(){ 
            
           $settings_list = SettingOther::where(function ($query) { $query->where('is_deleted', '=', NULL)->orWhere('is_deleted', '=', 0);})->orderBy('id', 'DESC')->get();     
         
      
            if($settings_list){ 
            $data               =   [];
            foreach($settings_list    as  $row){
            $data['id']        =   $row->id;
            $data['refund_deduction']       =   $row->refund_deduction;
            $data['return_period']       =   $row->return_period;
            $data['bid_charge']       =   $row->bid_charge; 
            $data['is_active']       =   $row->is_active;
            $data['is_deleted']       =   $row->is_deleted;
            $data['created_at']       =   $row->created_at; 
            }

            return $data;
            }else{ return false; }

        }

         
    
       
      
}
