<?php

namespace App\Http\Controllers\Organization\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization\OrganizationAdmin;
use App\Models\PasswordReset;
use App\Models\Email;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:organization')->except('logout');
    }
    public function index(){  
        return redirect('organization/login');
    }
    public function showAdminLoginForm(){  
        
        return view('organization.auth.login');
    }
    public function OrgLogout(Request $request){  
        
        Auth::guard('organization')->logout(); $request->session()->flush(); $request->session()->regenerate();
        return redirect('organization/login');
    }
    public function OrgLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('organization')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
             
            if(OrganizationAdmin::where('id', Auth::guard('organization')->user()->id)->first()->is_active == 1){ 
            
              return redirect('organization/dashboard'); }
                else{
                  
                    Auth::guard('organization')->logout(); $request->session()->flush(); $request->session()->regenerate();
                    return back()->withInput($request->only('email', 'remember'))->with('message',' This account is inactive.');
                }
    
            
        }
        return back()->withInput($request->only('email', 'remember'))->with('message',' These credentials do not match our records. ');
    }

    function forgotPassword(Request $request){
        $post = (object)$request->post();
        $user           =   Admin::where('email',$post->email)->first();
        if($user){        
            if ($user) {
                if ($user->is_active == 0 || $user->is_deleted == 1) {
                    return redirect('/password/reset')->with('message', 'This account not activated or disabled')->withInput();
                }else{
                    $resetLink = base64_encode(rand(100000, 999999) . 'resetpassword' . time() . '1');
                    $resetLink = urlencode($resetLink);
                    $currTime = date('Y-m-d H:i:s');
                    $data = array('active_link' => $resetLink, 'email_verified_at' => $currTime);
                    $msg = '<h4>Hi, ' . $user->fname . ' </h4>';
                    $msg .= 'You can reset password of ' . ucfirst(geSiteName()) . ' admin portal through this <a href="' . url('/reset/password/' . $resetLink) . '">Reset Password</a> link.';
                    $update = PasswordReset::create(['user_id'=>$user->id,'user_type'=>'admin','email'=>$post->email,'token'=>$resetLink]);
                    // dd($msg);
                    if ($update) Email::sendEmail(geAdminEmail(), $post->email, 'Reset Password', $msg);
                    
                    return redirect('/password/reset')->with('success', "Reset password link sent to your registered email!");
                }
            }
        }
        return redirect('/password/reset')->with('message', "We can't find a user with that e-mail address.")->withInput();
    }
    
    public function resetPassword($token){
        $reset = PasswordReset::where('token',$token)->where('is_deleted',0)->first();
        if ($reset){ // echo date('YmdHi',strtotime($reset->created_at)).' > '.date('YmdHi', strtotime('-20 minutes', strtotime(date('Y-m-d H:i:s'))))); die;
            if(date('YmdHi',strtotime($reset->created_at)) > date('YmdHi', strtotime('-20 minutes', strtotime(date('Y-m-d H:i:s'))))){
                return view('auth.passwords.reset', compact('reset')); 
            }else{ return redirect('/login')->with('error', 'Expired authentication link.'); }
        }else{ return redirect('/login')->with('error', 'Invalid authentication link.'); }
    }

    public function updatePassword(Request $request){
        $post               =   (object)$request->post();
        $reset              =   PasswordReset::where('token',$post->token)->where('is_deleted',0)->first();
        if($reset) {
            $update         =   $this->updateUserPassword($reset,$post);
            return redirect('/login')->with('success', 'Password reset successfully');
        }else{ return redirect('/login')->with('error', 'Invalid authentication link.'); }
    }
    
    function updateUserPassword($data,$post){
        $password                   =   Hash::make($post->password);
        if($data->user_type         ==  'admin'){       return  Admin::where('id',$data->user_id)->update(['password'=>$password]); }
        else if($data->user_type    ==  'seller'){      return  SellerSecurity::where('seller_id',$data->user_id)->update(['password_hash'=>$password]); }
        else if($data->user_type    ==  'customer'){    return  CustomerSecurity::where('customer_id',$data->user_id)->update(['password_hash'=>$password]); }
    }
    
    
}
