<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
use App\Models\Modules;
use App\Models\UserRoles;
use App\Models\Admin;
use App\Models\Auction;
use App\Models\AuctionHist;
use App\Models\UserRole;
use App\Models\Category;
use App\Models\CartItem;
use App\Models\Cart;
use App\Models\CartHistory;
use App\Models\Coupon;
use App\Models\CouponHist;
use App\Models\CustomerAddress;
use App\Models\CustomerAddressType;
use App\Models\Subcategory;
use App\Models\Store;
use App\Models\SellerReview;
use App\Models\SaleOrder;
use App\Models\SaleorderItems;
use App\Models\SalesOrderAddress;
use App\Models\SalesOrderPayment;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductDaily;
use App\Models\PrdAssignedTag;
use App\Models\PrdReview;
use App\Models\PrdShock_Sale;
use App\Models\PrdPrice;
use App\Models\RelatedProduct;
use App\Models\AssignedAttribute;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Carbon\Carbon;
use App\Rules\Name;
use Validator;

class VoucherController extends Controller
{
    //APPLY SELLER COUPON
    public function seller_voucher(Request $request)
    {
        if(!$user = validateToken($request->post('access_token'))){ return invalidToken(); }
        $user_id = $user['user_id'];
        $lang=$request->lang_id;
        $validator=  Validator::make($request->all(),[
            'coupon_code'=>['required','string'],
            'seller_id'=>['required','numeric']
        ]);
        $input = $request->all();

    if ($validator->fails()) 
    {    
      return ['httpcode'=>400,'status'=>'error','message'=>'Invalid parameters','data'=>['errors'=>$validator->messages()]];
    }
    else
    {
      $current_date=date('Y-m-d');
      $row = Coupon::where('is_active',1)->where('is_deleted',0)->where('ofr_code',$input['coupon_code'])->where('seller_id',$input['seller_id'])->first();
      
          
      
      if($row){
         
      $coupon_id= $row->id;
      $saleOrder =SaleOrder::where('cust_id',$user_id)->where('coupon_id',$coupon_id)->first();
      if($saleOrder)
      {
          return ['httpcode'=>400,'status'=>'error','message'=>'Already used','data'=>['errors'=>'Coupon already used before']];
      }
      else
      { 
      $c_list =[];
      $coupon_details=[];
      
        if($row->validity_type=="range")
        {

          $range_coupon = Coupon::where('id',$row->id)->whereDate('valid_from','<=',$current_date)->whereDate('valid_to','>=',$current_date)->first();
          if($range_coupon){  
           if($row->ofr_value_type=="percentage")
               {
                    $discount = $row->ofr_value." "."%";

               }
               else
               {
                    $discount = $row->ofr_value." "."RM";
               }
                    $coupon_details['coupon_id']=$row->id;
                    $coupon_details['title']=$this->get_content($row->cpn_title_cid,$lang);
                    $coupon_details['desc']=$this->get_content($row->cpn_desc_cid,$lang);
                    $coupon_details['offer']=$discount." ".$row->ofr_type;
                    $coupon_details['coupon_code']=$row->ofr_code;
                    $coupon_details['minimum_purchase']=$row->ofr_min_amount;
                    $coupon_details['offer_type']=$row->ofr_type;
                    $coupon_details['offer_value']=$row->ofr_value;
                    $coupon_details['offer_value_in']=$row->ofr_value_type;

               if($row->purchase_type=='number')
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']=$row->purchase_number;
                $coupon_details['previous_order_amount']="";
               } 
               else
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']="";
                $coupon_details['previous_order_amount']=$row->purchase_amount;
               }    
                   
            }

          }
           if($row->validity_type=="days")
          {
            
            $created_date=$row->created_at;
            $valid_date=$row->created_at->addDays($row->valid_days);
            $current_dates=Carbon::now();
            //$diff_in_days = $current_date->diffInDays($valid_date);
            $validity =$valid_date->gte($current_dates);
          if($validity==1){  
           if($row->ofr_value_type=="percentage")
               {
                    $discount = $row->ofr_value." "."%";

               }
               else
               {
                    $discount = $row->ofr_value." "."RM";
               }
                    $coupon_details['coupon_id']=$row->id;
                    $coupon_details['title']=$this->get_content($row->cpn_title_cid,$lang);
                    $coupon_details['desc']=$this->get_content($row->cpn_desc_cid,$lang);
                    $coupon_details['offer']=$discount." ".$row->ofr_type;
                    $coupon_details['coupon_code']=$row->ofr_code;
                    $coupon_details['minimum_purchase']=$row->ofr_min_amount;
                    $coupon_details['offer_type']=$row->ofr_type;
                    $coupon_details['offer_value']=$row->ofr_value;
                    $coupon_details['offer_value_in']=$row->ofr_value_type;

               if($row->purchase_type=='number')
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']=$row->purchase_number;
                $coupon_details['previous_order_amount']="";
               } 
               else
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']="";
                $coupon_details['previous_order_amount']=$row->purchase_amount;
               }    
                    
                    }

          }
                   if($coupon_details)
                   {
                    $c_list  = $coupon_details;
                   }

          
        
        return ['httpcode'=>200,'status'=>'success','message'=>'Coupon list','data'=>['coupon'=>$c_list]];
      }
      }//end of row
      else
      {
          return ['httpcode'=>400,'status'=>'error','message'=>'Invalid seller','data'=>['coupon'=>'Invalid seller']];
      }
      
    
      
      }      
    }
    
    
    //APPLY ADMIN COUPON
    public function admin_voucher(Request $request)
    {
        if(!$user = validateToken($request->post('access_token'))){ return invalidToken(); }
        $user_id = $user['user_id'];
        $lang=$request->lang_id;
        $validator=  Validator::make($request->all(),[
            'coupon_code'=>['required','string']
        ]);
        $input = $request->all();

    if ($validator->fails()) 
    {    
      return ['httpcode'=>400,'status'=>'error','message'=>'Invalid parameters','data'=>['errors'=>$validator->messages()]];
    }
    else
    {
      $current_date=date('Y-m-d');
      $row = Coupon::where('is_active',1)->where('is_deleted',0)->where('ofr_code',$input['coupon_code'])->where('seller_id',0)->first();
      
      if($row){
          $coupon_id= $row->id;
      $saleOrder =SaleOrder::where('cust_id',$user_id)->where('coupon_id',$coupon_id)->first();
      if($saleOrder)
      {
          return ['httpcode'=>400,'status'=>'error','message'=>'Already used','data'=>['errors'=>'Coupon already used before']];
      }
      else
      { 
      $c_list =[];
      $coupon_details=[];
      
        if($row->validity_type=="range")
        {

          $range_coupon = Coupon::where('id',$row->id)->whereDate('valid_from','<=',$current_date)->whereDate('valid_to','>=',$current_date)->first();
          if($range_coupon){  
           if($row->ofr_value_type=="percentage")
               {
                    $discount = $row->ofr_value." "."%";

               }
               else
               {
                    $discount = $row->ofr_value." "."RM";
               }
                    $coupon_details['coupon_id']=$row->id;
                    $coupon_details['title']=$this->get_content($row->cpn_title_cid,$lang);
                    $coupon_details['desc']=$this->get_content($row->cpn_desc_cid,$lang);
                    $coupon_details['offer']=$discount." ".$row->ofr_type;
                    $coupon_details['coupon_code']=$row->ofr_code;
                    $coupon_details['minimum_purchase']=$row->ofr_min_amount;
                    $coupon_details['offer_type']=$row->ofr_type;
                    $coupon_details['offer_value']=$row->ofr_value;
                    $coupon_details['offer_value_in']=$row->ofr_value_type;

               if($row->purchase_type=='number')
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']=$row->purchase_number;
                $coupon_details['previous_order_amount']="";
               } 
               else
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']="";
                $coupon_details['previous_order_amount']=$row->purchase_amount;
               }    
                   
            }

          }
           if($row->validity_type=="days")
          {
            
            $created_date=$row->created_at;
            $valid_date=$row->created_at->addDays($row->valid_days);
            $current_dates=Carbon::now();
            //$diff_in_days = $current_date->diffInDays($valid_date);
            $validity =$valid_date->gte($current_dates);
          if($validity==1){  
           if($row->ofr_value_type=="percentage")
               {
                    $discount = $row->ofr_value." "."%";

               }
               else
               {
                    $discount = $row->ofr_value." "."RM";
               }
                    $coupon_details['coupon_id']=$row->id;
                    $coupon_details['title']=$this->get_content($row->cpn_title_cid,$lang);
                    $coupon_details['desc']=$this->get_content($row->cpn_desc_cid,$lang);
                    $coupon_details['offer']=$discount." ".$row->ofr_type;
                    $coupon_details['coupon_code']=$row->ofr_code;
                    $coupon_details['minimum_purchase']=$row->ofr_min_amount;
                    $coupon_details['offer_type']=$row->ofr_type;
                    $coupon_details['offer_value']=$row->ofr_value;
                    $coupon_details['offer_value_in']=$row->ofr_value_type;

               if($row->purchase_type=='number')
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']=$row->purchase_number;
                $coupon_details['previous_order_amount']="";
               } 
               else
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']="";
                $coupon_details['previous_order_amount']=$row->purchase_amount;
               }    
                    
                    }

          }
                   if($coupon_details)
                   {
                    $c_list  = $coupon_details;
                   }

          
        
        return ['httpcode'=>200,'status'=>'success','message'=>'Coupon list','data'=>['coupon'=>$c_list]];
      }
      }//end of row
      else
      {
          return ['httpcode'=>400,'status'=>'error','message'=>'Invalid coupon','data'=>['coupon'=>'Invalid coupon']];
      }
      }      
    }
    
    public function seller_voucher1(Request $request)
    {
        $lang=$request->lang_id;
        $validator=  Validator::make($request->all(),[
            'seller_id' =>['required','numeric']
        ]);
        $input = $request->all();

    if ($validator->fails()) 
    {    
      return ['httpcode'=>400,'status'=>'error','message'=>'Invalid parameters','data'=>['errors'=>$validator->messages()]];
    }
    else
    {
      $current_date=date('Y-m-d');
      $coupon = Coupon::where('is_active',1)->where('is_deleted',0)->where('seller_id',$input['seller_id'])->get();

      $c_list =[];
      $coupon_details=[];
      foreach($coupon as $row)
      {
        if($row->validity_type=="range")
        {

          $range_coupon = Coupon::where('id',$row->id)->whereDate('valid_from','<=',$current_date)->whereDate('valid_to','>=',$current_date)->first();
          if($range_coupon){  
           if($row->ofr_value_type=="percentage")
               {
                    $discount = $row->ofr_value." "."%";

               }
               else
               {
                    $discount = $row->ofr_value." "."RM";
               }
                    $coupon_details['coupon_id']=$row->id;
                    $coupon_details['title']=$this->get_content($row->cpn_title_cid,$lang);
                    $coupon_details['desc']=$this->get_content($row->cpn_desc_cid,$lang);
                    $coupon_details['offer']=$discount." ".$row->ofr_type;
                    $coupon_details['coupon_code']=$row->ofr_code;
                    $coupon_details['minimum_purchase']=$row->ofr_min_amount;
                    $coupon_details['offer_type']=$row->ofr_type;

               if($row->purchase_type=='number')
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']=$row->purchase_number;
                $coupon_details['previous_order_amount']="";
               } 
               else
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']="";
                $coupon_details['previous_order_amount']=$row->purchase_amount;
               }    
                   
            }

          }
           if($row->validity_type=="days")
          {
            
            $created_date=$row->created_at;
            $valid_date=$row->created_at->addDays($row->valid_days);
            $current_dates=Carbon::now();
            //$diff_in_days = $current_date->diffInDays($valid_date);
            $validity =$valid_date->gte($current_dates);
          if($validity==1){  
           if($row->ofr_value_type=="percentage")
               {
                    $discount = $row->ofr_value." "."%";

               }
               else
               {
                    $discount = $row->ofr_value." "."RM";
               }
                    $coupon_details['coupon_id']=$row->id;
                    $coupon_details['title']=$this->get_content($row->cpn_title_cid,$lang);
                    $coupon_details['desc']=$this->get_content($row->cpn_desc_cid,$lang);
                    $coupon_details['offer']=$discount." ".$row->ofr_type;
                    $coupon_details['coupon_code']=$row->ofr_code;
                    $coupon_details['minimum_purchase']=$row->ofr_min_amount;
                    $coupon_details['offer_type']=$row->ofr_type;
                    $coupon_details['offer_value_in']=$row->ofr_value_type;

               if($row->purchase_type=='number')
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']=$row->purchase_number;
                $coupon_details['previous_order_amount']="";
               } 
               else
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']="";
                $coupon_details['previous_order_amount']=$row->purchase_amount;
               }    
                    
                    }

          }
                   if($coupon_details)
                   {
                    $c_list[]  = $coupon_details;
                   }

          
        }
        return ['httpcode'=>200,'status'=>'success','message'=>'Coupon list','data'=>['coupon'=>$c_list]];
      }      
    }

    public function admin_voucher1(Request $request)
    {
        $lang=$request->lang_id;

      $current_date=date('Y-m-d');
      $coupon = Coupon::where('is_active',1)->where('is_deleted',0)->where('seller_id',0)->get();
      $c_list =[];
      $coupon_details=[];
      foreach($coupon as $row)
      {
        if($row->validity_type=="range")
        {

          $range_coupon = Coupon::where('id',$row->id)->whereDate('valid_from','<=',$current_date)->whereDate('valid_to','>=',$current_date)->first();
          if($range_coupon){  
           if($row->ofr_value_type=="percentage")
               {
                    $discount = $row->ofr_value." "."%";

               }
               else
               {
                    $discount = $row->ofr_value." "."RM";
               }
                    $coupon_details['coupon_id']=$row->id;
                    $coupon_details['title']=$this->get_content($row->cpn_title_cid,$lang);
                    $coupon_details['desc']=$this->get_content($row->cpn_desc_cid,$lang);
                    $coupon_details['offer']=$discount." ".$row->ofr_type;
                    $coupon_details['coupon_code']=$row->ofr_code;
                    $coupon_details['minimum_purchase']=$row->ofr_min_amount;
                    $coupon_details['offer_type']=$row->ofr_type;

               if($row->purchase_type=='number')
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']=$row->purchase_number;
                $coupon_details['previous_order_amount']="";
               } 
               else
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']="";
                $coupon_details['previous_order_amount']=$row->purchase_amount;
               }    
                   
            }

          }
           if($row->validity_type=="days")
          {
            
            $created_date=$row->created_at;
            $valid_date=$row->created_at->addDays($row->valid_days);
            $current_dates=Carbon::now();
            //$diff_in_days = $current_date->diffInDays($valid_date);
            $validity =$valid_date->gte($current_dates);
          if($validity==1){  
           if($row->ofr_value_type=="percentage")
               {
                    $discount = $row->ofr_value." "."%";

               }
               else
               {
                    $discount = $row->ofr_value." "."RM";
               }
                    $coupon_details['coupon_id']=$row->id;
                    $coupon_details['title']=$this->get_content($row->cpn_title_cid,$lang);
                    $coupon_details['desc']=$this->get_content($row->cpn_desc_cid,$lang);
                    $coupon_details['offer']=$discount." ".$row->ofr_type;
                    $coupon_details['coupon_code']=$row->ofr_code;
                    $coupon_details['minimum_purchase']=$row->ofr_min_amount;
                    $coupon_details['offer_type']=$row->ofr_type;
                    $coupon_details['offer_value_in']=$row->ofr_value_type;

               if($row->purchase_type=='number')
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']=$row->purchase_number;
                $coupon_details['previous_order_amount']="";
               } 
               else
               {
                $coupon_details['purchase_type']=$row->purchase_type;
                $coupon_details['previous_order_count']="";
                $coupon_details['previous_order_amount']=$row->purchase_amount;
               }    
                    
                    }

          }
                   if($coupon_details)
                   {
                    $c_list[]  = $coupon_details;
                   }

          
        }
        return ['httpcode'=>200,'status'=>'success','message'=>'Coupon list','data'=>['coupon'=>$c_list]];
       
    }




    function get_content($field_id,$lang){ 
     
        if($lang=='')
        { 
        $language =DB::table('glo_lang_lk')->where('is_active', 1)->first();
        $language_id=$language->id;
        }
        else
        {
            $language_id=$lang;
        }
        $content_table=DB::table('cms_content')->where('cnt_id', $field_id)->where('lang_id', $language_id)->first();
        if(!empty($content_table)){ 
        $return_cont = $content_table->content;
        return $return_cont;
        }
        else
            { return false; }
        }
}
