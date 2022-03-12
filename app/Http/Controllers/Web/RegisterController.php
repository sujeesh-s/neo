<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic as Image;
use Tenancy;
use Session;
use DB;
use App\Models\Modules;
// use App\Models\UserRoles;
use App\Models\Country;
use App\Models\Admin;
use App\Models\UserRole;
use App\Models\SalesOrder;
use App\Models\Product;
use App\Models\customer\CustomerMaster;
use App\Models\SellerInfo;
use App\Models\BusinessCategory;
use App\Models\UserVisit;
use App\Rules\Name;
use App\Models\Tenant;
use App\Models\TenantMeta;
use App\Models\TenantOrganization;
use App\Models\EmployeeRange;
use App\Models\Language;
use App\Models\Organization\OrganizationAdmin;
use App\Models\Organization\Organization;
use App\Models\Organization\OrganizationAddress;
use Validator;

class RegisterController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 

    

    public function register()
    { 
       
        $data['title']              =   'Register';
        $data['menu']               =   'register';
        $data['countries']          =   getDropdownData(Country::where('is_deleted',0)->get(),'id','country_name');
        return view('frontend.register',$data);
        }




    function saveOrg(Request $request){

        $post               =  (object)$request->post(); 
       


        $tenant = Tenant::create(['id' => $post->domain_name]);
        if($tenant)
        { 
            $tenant_arr =[];
            $tenant_arr['tenant_id'] = $tenant->id; 
            $tenant_arr['name'] = $post->fname; 
            $tenant_arr['job'] = $post->job; 
            $tenant_arr['org_name'] = $post->org_name; 
            $tenant_arr['country'] = $post->country; 
            $tenant_arr['email'] = $post->email;
            $tenant_arr['phone'] = $post->phone;
            $tenant_arr['username'] = $post->username; 
            $tenant_arr['password'] = Hash::make($post->password); 

            $tenant_org = TenantOrganization::create($tenant_arr);

            $tenant_domain = $post->domain_name.".".\config('services.central.app');
            $tenant->domains()->create(['domain' => $tenant_domain]);

            $tenant_db = $tenant->tenancy_db_name;
            
       $tenant_user = $tenant->run(function ($tenant) use ($post) {
  $org_admin = [];
            $org_admin['fname'] = $post->fname;
            $org_admin['email'] = $post->email;
            $org_admin['phone'] = $post->phone;
            $org_admin['username'] = $post->username; 
            $org_admin['password'] = Hash::make($post->password);
            $org_admin_id = OrganizationAdmin::create($org_admin)->id;

            $org_arr = [];
            $org_arr['tenant_id'] = $tenant->id; 
            $org_arr['name'] = $post->org_name;
            $org_arr['email'] = $post->email;
            $org_arr['phone'] = $post->phone;
            $org_arr['org_admin'] = $org_admin_id; 
            $org_id = Organization::create($org_arr)->id;

            $org_address_arr = [];
            $org_address_arr['country_id'] = $post->country;
            $org_id = OrganizationAddress::create($org_address_arr)->id;

});

            


        }


       
        // return redirect(route('org.welcome'));
        return \Redirect::route('org.welcome', $tenant);

    }
    function welcomeUser($tenant){  


        $tenant = Tenant::where('id',$tenant)->first();
        $tenant_user = $tenant->run(function ($tenant) {
        return  OrganizationAdmin::where('is_deleted',0)->first();
        });



           $data['title']              =   'Welcome';
           $data['tenant']              =   $tenant->id;
        $data['name']               =   $tenant_user->fname;
        $data['countries']          =   getDropdownData(Country::where('is_deleted',0)->get(),'id','country_name');
        $data['business_category']          =   getDropdownData(BusinessCategory::where('is_deleted',0)->get(),'id','name');
        $data['employee_range']          =   getDropdownData(EmployeeRange::where('is_deleted',0)->get(),'id','range');
        $data['language']          =    getDropdownData(Language::where('is_deleted',0)->get(),'id','glo_lang_name');
        
        return view('frontend.welcome',$data);

    }
     function validateOrg(Request $request){  
        $post                   =   (object)$request->post(); 
       
        $existName              =   $validEmail = $validPhone = $error = false;
       
            $rules          =   [
                                    'fname'                 =>  ['required', 'string','max:100'],
                                    'job'                 =>  ['required', 'string','max:100'],
                                    'org_name'                 =>  ['required', 'string','max:100','unique:tenant_organization,org_name'],
                                    'country'                 =>  ['required'],
                                    'email'                 =>  'required|string|email|max:100|unique:tenant_organization,email',
                                    'phone'                 =>  'required|numeric|digits_between:7,12|unique:tenant_organization,phone',
                                    'username'                 =>  ['required', 'string','max:100','unique:tenant_organization,username'],
                                    'password'                 =>  ['required', 'string','min:6'],
                                    'domain_name'                 =>  ['required', 'alpha_dash','max:100','unique:domains,tenant_id'],
                                ];
         
        $validator              =   Validator::make($request->post() ,$rules);
        if ($validator->fails()) {
           foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; }
        } 
        // if($error == false){ 
        //         $validEmail     =   Tenant::ValidateUnique($post->$dataKey['email'],$post->id);
        //         $validEmail     =   Tenant::ValidateUnique($post->$dataKey['email'],$post->id);
        //         $validPhone     =   Tenant::ValidatePhone($post->$dataKey['phone'],$post->id);
            
        // }
        if($existName){ $error['name']    =   $existName; }
        else if($validEmail){ $error['email']    =   $validEmail; }
        else if($validPhone){ $error['phone']    =   $validPhone; }
        if($error) { return $error; }else{ return 'success'; } return 'success'; 
    }

     function validateWelcomeform(Request $request){  
        $post                   =   (object)$request->post(); 
        
        $existName              =   $validEmail = $validPhone = $error = false;
       
            $rules          =   [
                                    'org_type'                 =>  ['required'],
                                    'business_category'                 =>  ['required'],
                                    'employee_range'                 =>  ['required'],
                                    'language'                 =>  ['required'],
                                    
                                ];
         
        $validator              =   Validator::make($request->post() ,$rules);
        if ($validator->fails()) {
           foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; }
        } 
  
        if($error) { return $error; }else{ return 'success'; } return 'success'; 
    }

    function saveWelcomeform(Request $request){

        $post               =  (object)$request->post(); 
       
       

        $tenant = Tenant::where('id',$post->tenant)->first();  
        $tenant_user = $tenant->run(function ($tenant) use($post) {
          
          $org_arr = [];
            $org_arr['type'] = $post->org_type;
            $org_arr['business_category_id'] = $post->business_category;
            $org_arr['employee_range'] = $post->employee_range;
            $org_arr['language_id'] = $post->language; 
            $org_id = Organization::where('tenant_id',$tenant->id)->update($org_arr);  
        });

       
       $redir_domain = "//".$tenant->id.".".\config('services.central.app'); 
        
        return \Redirect::to($redir_domain);

    }
    
}
