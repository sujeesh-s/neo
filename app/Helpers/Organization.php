<?php
use App\Models\CmsContent;
use App\Models\Organization\UserRole;
use App\Models\Setting;
use App\Models\Organization\Modules;
use App\Models\Admin;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\AppVersion;
use App\Models\Domains;


if (!function_exists('roleData')) {
    function roleData() { return UserRole::where('id', auth()->user()->role_id)->first(); }
}
if (!function_exists('getTenantDomain')) {
    function getTenantDomain() { return tenant()->domainInfo->domain; }
}

if (!function_exists('orgsidebarMenu')) {
    function orgsidebarMenu(){ 

$menu_list = tenancy()->central(function ($tenant) {
    return Modules::visibleModules(auth()->user()->role_id);
});

        // dd(Modules::visibleModules(auth()->user()->role_id));
        // $menu_list = Modules::visibleModules(auth()->user()->role_id);
        
        if($menu_list){
        if(count($menu_list) >0){
            return $menu_list;
        }else {
           return array(); 
        }    
        }else {
            
           return array(); 
        } 
        
        
        
    }
}