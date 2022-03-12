<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Email extends Model
{
    static function sendEmail($from = NULL, $to = NULL, $sub = NULL, $msg = NULL){
        $system_name    =   "Thiruketheeswaram Temple";
        $headers        =   "MIME-Version: 1.0" . "\r\n";
        $headers        .=  "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers        .=  'From: ' . $system_name . '<' . $from . '>' . "\r\n";
        $headers        .=  "Reply-To: " . $system_name . '<' . $from . '>' . "\r\n";
        $headers        .=  "Return-Path: " . $system_name . '<' . $from . '>' . "\r\n";
        $headers        .=  "X-Priority: 3\r\n";
        $headers        .=  "X-Mailer: PHP" . phpversion() . "\r\n";
        $headers        .=  "Organization: " . $system_name . "\r\n";
      //  echo $from.' -- '.$to.' -- '.$sub.' -- '.$msg;
        @mail($to, $sub, $msg, $headers, "-f " . $from);
    }
    static function sendActivationMail($user, $userData){
        
        $mailContent                    =   DB::table('email_template')->where('identifier', 'welcome_email')->first()->description;
        if($mailContent){
            $msg                        = str_replace('{{User}}', $userData['name'], $mailContent);
            $msg                        = str_replace('{{active_link}}', 'account/activate/'.$user["active_link"], $msg);
        }else{
            $msg                        =   '<h4>Hi, '.$userData['name'].' </h4>';
            $msg                        .=  'Thanks for registering with '.geSiteName().' You can activate your account throuth this <a href="'.url('/account/activate/'.$user["active_link"]).'">Activate</a> link.';
        }
        return $msg;
    }
    static function welcomeMailToCustomer($customer){ 
        
        $query                          =   DB::table('email_template')->where('identifier', 'welcome_email_customer');
        if($query->count()              >   0){ 
            $mailContent                =   $query->first()->description;
            $msg                        =   str_replace('{{User}}', $customer->name, $mailContent);
            $msg                        =   str_replace('{{email}}', $customer->email, $msg);
            $msg                        =   str_replace('{{password}}', $customer->password, $msg);
        }else{
            $msg                        =   '<h4>Hi, '.$customer->name.' </h4>';
            $msg                        .=  'Thanks for registering with '.geSiteName().' Your login credentials given below <br /><br /> Email : '.$customer->email.'<br /><br />Password : '.$customer->password;
        }
        return $msg;
    }
    
    static function getContactMailTemplate($data) {

        $mailContent = DB::table('email_template')->where('identifier', 'contact_email')->first()->description;
        if ($mailContent) {
            $msg1 = str_replace('{{Name}}', $data['name'], $mailContent);
            $msg2 = str_replace('{{EmailId}}', $data['email'], $msg1);
            $msg3 = str_replace('{{Subject}}', $data['subject'], $msg2);
            $msg = str_replace('{{Message}}', $data['message'], $msg3);
        } else {
            $msg = '<p><strong>Name:</strong> ' . $data['name'] . ' </p>';
            $msg .= '<p><strong>Email Id:</strong> ' . $data['email'] . ' </p>';
            $msg .= '<p><strong>Subject:</strong> ' . $data['subject'] . ' </p>';
            $msg .= '<p><strong>Message:</strong> ' . $data['message'] . ' </p>';
        }
        return $msg;
    }
    
}
