<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SuperAdmin extends Authenticatable{
    use Notifiable;
    protected $guard = 'users';
    protected $fillable = ['name', 'email', 'password',];
    protected $hidden = ['password', 'remember_token',];

    
    
    static function ValidateUnique($field,$post,$id) {
        $query                  =   Admin::where($field,$post->email)->first();
        if($query){
            if($query->id       !=  $id){ 
                if($query->status   ==  0){ return 'This '. $field .' account has been disabled'; }
                return 'This '.$field.' already has been taken'; 
            }
        }else{ return false; }
    }
    
    static function ValidatePhone($field,$post,$id){  
        $query                  =   Admin::where($field,$post->$field)->where('isd_code',$post->isd_code)->first();
        if($query){ 
            if($query->id       !=  $id){ 
                if($query->status   ==  0){ return 'This account has been disabled'; }
                return 'This phone already has been taken'; 
            }
        }else{ return false; }
    }
}
