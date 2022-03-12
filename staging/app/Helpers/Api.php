<?php
use App\Models\CustomerLogin;
use App\Models\CustomerMaster;
use App\Models\Setting;

if (!function_exists('validateToken')){
    function validateToken($token){
        $query                      =   CustomerLogin::where('access_token',$token)->where('is_login',1)->where('is_deleted',0);
        if($query->exists()){ 
            $user                   =   CustomerMaster::where('id',$query->first()->user_id)->first(); 
            if($user->info->profile_img != NULL){ $avatar = config('app.storage_url').$user->info->profile_img; }else{ $avatar = config('app.storage_url').'/app/public/no-avatar.png'; }
            $data['user_id']        =   $user->id;                              $data['first_name']         =   $user->info->first_name;
            $data['last_name']      =   $user->info->last_name;                 $data['email']              =   $user->custEmail($user->email);
            $data['phone']          =   $user->custPhone($user->phone);    
            $data['avatar']         =   $avatar;
            return $data;
        }else{ return false; }
    }
}if (!function_exists('invalidToken')){
    function invalidToken(){
        return array('httpcode'=>401,'status'=>'error','message'=>'Invalid Access Token','data'=>['message'=>'Invalid Access Token','redirect'=>'login']); 
    }
}if (!function_exists('smsCredientials')){
    function smsCredientials(){
        $data['sms_sender_id']  =   $data['sms_username'] = $data['sms_password'] = '';
        $query                  =   Setting::where('is_active',1)->where('is_deleted',0)->whereIn('type',['sms_sender_id','sms_username','sms_password']);
        if($query->count()  >   0){ foreach($query->get() as $row){ $data[$row->type] = $row->value; } }
        return (object) $data;
    }
}if (!function_exists('sendSms')){
    function sendSms($phone     = null, $smscontent = null){
        $sms                    =   smsCredientials(); $route= "I";
        $innumber               =   substr($phone,0,3);
        if($innumber=='+91')    {   $route= "T"; }else if(substr($phone,0,2)=='91'){ $route= "T"; }
        $message                =   urlencode($smscontent);
        $curl                   =   curl_init();
        echo "http://sms.estrrado.com/sendsms?uname=$sms->sms_username&pwd=$sms->sms_password&senderid=$sms->sms_sender_id&to=$phone&msg=$message&route=$route"; die;
        curl_setopt_array($curl, array(
            CURLOPT_URL         => "http://sms.estrrado.com/sendsms?uname=$sms->sms_username&pwd=$sms->sms_password&senderid=$sms->sms_sender_id&to=$phone&msg=$message&route=$route",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING    =>  "",
            CURLOPT_MAXREDIRS   =>  10,
            CURLOPT_TIMEOUT     =>  30,
            CURLOPT_HTTP_VERSION=>  CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST=> "GET",
        ));
        $response               =   curl_exec($curl);
        $err                    =   curl_error($curl);
        curl_close($curl);
        if ($err) { return "cURL Error #:" . $err; } else { return $response; }
    }
}


if (!function_exists('push')){
    function push(){
        $data['fire_base_id']   =   '';
        $query                  =   DB::table('settings')->where('status',1)->whereIn('type',['fire_base_id']);
        if($query->count()      >   0){ foreach($query->get() as $row){ $data[$row->type] = $row->value; } }
        return (object) $data;
    }
}
