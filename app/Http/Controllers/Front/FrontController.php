<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Crypt;
use Mail;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        $result['home_categories']=DB::table('categories')
                ->where(['status'=>1])
                ->get();


        foreach($result['home_categories'] as $list){
            $result['home_categories_product'][$list->id]=
                DB::table('products')
                ->where(['status'=>1])
                ->where(['category_id'=>$list->id])
                ->get();

            foreach($result['home_categories_product'][$list->id] as $list1){
                $result['home_product_attr'][$list1->id]=
                    DB::table('product_attr')
                    ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                    ->leftJoin('colores','colores.id','=','product_attr.color_id')
                    ->where(['product_attr.product_id'=>$list1->id])
                    ->get();
                
            }
        }

        $result['home_brand']=DB::table('brands')
                ->where(['status'=>1])
                ->get();
        

        $result['home_featured_product'][$list->id]=
                DB::table('products')
                ->where(['status'=>1])
                ->where(['is_featured'=>1])
                ->get();

        foreach($result['home_featured_product'][$list->id] as $list1){
            $result['home_featured_product_attr'][$list1->id]=
                DB::table('product_attr')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colores','colores.id','=','product_attr.color_id')
                ->where(['product_attr.product_id'=>$list1->id])
                ->get();
            
        }

        $result['home_tranding_product'][$list->id]=
            DB::table('products')
            ->where(['status'=>1])
            ->where(['is_trending'=>1])
            ->get();

        foreach($result['home_tranding_product'][$list->id] as $list1){
            $result['home_tranding_product_attr'][$list1->id]=
                DB::table('product_attr')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colores','colores.id','=','product_attr.color_id')
                ->where(['product_attr.product_id'=>$list1->id])
                ->get();
            
        }

        $result['home_discounted_product'][$list->id]=
            DB::table('products')
            ->where(['status'=>1])
            ->where(['is_descounted'=>1])
            ->get();

        foreach($result['home_discounted_product'][$list->id] as $list1){
            $result['home_discounted_product_attr'][$list1->id]=
                DB::table('product_attr')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colores','colores.id','=','product_attr.color_id')
                ->where(['product_attr.product_id'=>$list1->id])
                ->get();
            
        }
         
        $result['home_banner']=DB::table('home_banners')
            ->where(['status'=>1])
            ->get();

        return view('front.index',$result);
    }

    public function category(Request $request,$slug)
    {    
        $sort="";
        $sort_txt="";
        $filter_price_start="";
        $filter_price_end="";
        $color_filter="";
        $colorFilterArr=[];
        if($request->get('sort')!==null){
            $sort=$request->get('sort');
        }    
        
        $query=DB::table('products');
        $query=$query->leftJoin('categories','categories.id','=','products.category_id');
        $query=$query->leftJoin('product_attr','products.id','=','product_attr.product_id');
        $query=$query->where(['products.status'=>1]);
        $query=$query->where(['categories.category_slug'=>$slug]);
        if($sort=='name'){
            $query=$query->orderBy('products.name','asc');
            $sort_txt="Product Name";
        }
        if($sort=='date'){
            $query=$query->orderBy('products.id','desc');
            $sort_txt="Date";
        }
        if($sort=='price_desc'){
            $query=$query->orderBy('product_attr.price','desc');
            $sort_txt="Price - DESC";
        }if($sort=='price_asc'){
            $query=$query->orderBy('product_attr.price','asc');
            $sort_txt="Price - ASC";
        }
        if($request->get('filter_price_start')!== null && $request->get('filter_price_end')!==null){
            $filter_price_start = $request->get('filter_price_start');
            $filter_price_end = $request->get('filter_price_end');
            if($filter_price_start>0 && $filter_price_end>0){
            $query=$query->whereBetween('product_attr.price',[$filter_price_start, $filter_price_end]);
            }
        }
        if($request->get('color_filter')!== null){
            $color_filter=$request->get('color_filter');
            $colorFilterArr=explode(":", $color_filter);
            $colorFilterArr= array_filter($colorFilterArr);
            $query=$query->where(['product_attr.color_id'=>$request->get('color_filter')]);
        }

        $query=$query->distinct()->select('products.*');
        $query=$query->get();
        $result['product']=$query;
        
        foreach($result['product'] as $list1){
           
            $query1=DB::table('product_attr');
            $query1=$query1->leftJoin('sizes','sizes.id','=','product_attr.size_id');
            $query1=$query1->leftJoin('colores','colores.id','=','product_attr.color_id');
            $query1=$query1->where(['product_attr.product_id'=>$list1->id]);
            $query1=$query1->get();

            $result['product_attr'][$list1->id]=$query1;

        }
        $result['colors']=DB::table('colores')
            ->where(['status'=>1])
            ->get();

        $result['categories_left']=DB::table('categories')
        ->where(['status'=>1])
        ->get();
        $result['slug']=$slug;
        $result['sort']=$sort;
        $result['sort_txt']=$sort_txt;
        $result['filter_price_end']=$filter_price_end;
        $result['filter_price_start']=$filter_price_start;
        $result['color_filter']=$color_filter;
        $result['colorFilterArr']=$colorFilterArr;
        
        
        return view('front.category',$result);
    }
    public function product(Request $request,$slug)
    {
        $result['product']=
            DB::table('products')
            ->where(['status'=>1])
            ->where(['slug'=>$slug])
            ->get();

        foreach($result['product'] as $list1){
            $result['product_attr'][$list1->id]=
                DB::table('product_attr')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colores','colores.id','=','product_attr.color_id')
                ->where(['product_attr.product_id'=>$list1->id])
                ->get();
        }

        foreach($result['product'] as $list1){
            $result['product_images'][$list1->id]=
                DB::table('product_images')
                ->where(['product_images.product_id'=>$list1->id])
                ->get();
        }
        $result['related_product']=
            DB::table('products')
            ->where(['status'=>1])
            ->where('slug','!=',$slug)
            ->where(['category_id'=>$result['product'][0]->category_id])
            ->get();
        foreach($result['related_product'] as $list1){
            $result['related_product_attr'][$list1->id]=
                DB::table('product_attr')
                ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
                ->leftJoin('colores','colores.id','=','product_attr.color_id')
                ->where(['product_attr.product_id'=>$list1->id])
                ->get();
        }
        
        return view('front.product',$result);
    }

    public function add_to_cart(Request $request)
    {
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid=$request->session()->get('FRONT_USER_ID');
            $usertype="Reg";
        }else{
            $uid=getUserTempId();
            $usertype="Not-Reg";
        }
        
        $size_id=$request->post('size_id');
        $color_id=$request->post('color_id');
        $pqty=$request->post('pqty');
        $product_id=$request->post('product_id');

        $result=DB::table('product_attr')
            ->select('product_attr.id')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftJoin('colores','colores.id','=','product_attr.color_id')
            ->where(['product_id'=>$product_id])
            ->where(['sizes.size'=>$size_id])
            ->where(['colores.color'=>$color_id])
            ->get();
        $product_attr_id=$result[0]->id;


        $check=DB::table('cart')
            ->where(['userid'=>$uid])
            ->where(['usertype'=>$usertype])
            ->where(['product_id'=>$product_id])
            ->where(['product_attr_id'=>$product_attr_id])
            ->get();
        if(isset($check[0])){
            $update_id=$check[0]->id;
            if($pqty==0){
                DB::table('cart')
                    ->where(['id'=>$update_id])
                    ->delete();
                $msg="removed";
            }else{
                DB::table('cart')
                    ->where(['id'=>$update_id])
                    ->update(['qty'=>$pqty]);
                $msg="updated";
            }
            
        }else{
            $id=DB::table('cart')->insertGetId([
                'userid'=>$uid,
                'usertype'=>$usertype,
                'product_id'=>$product_id,
                'product_attr_id'=>$product_attr_id,
                'qty'=>$pqty,
                'added_on'=>date('Y-m-d h:i:s')
            ]);
            $msg="added";
        }
        $result=DB::table('cart')
            ->leftJoin('products','products.id','=','cart.product_id')
            ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftJoin('colores','colores.id','=','product_attr.color_id')
            ->where(['userid'=>$uid])
            ->where(['usertype'=>$usertype])
            ->select('cart.qty','products.name','products.image','sizes.size','colores.color','product_attr.price','products.slug','products.id as pid','product_attr.id as attr_id')
            ->get();    
        return response()->json(['msg'=>$msg,'data'=>$result,'totalcart'=>count($result)]);
    }

    public function cart(Request $request)
    {
        if($request->session()->has('FRONT_USER_LOGIN')){
            $uid=$request->session()->get('FRONT_USER_ID');
            $usertype="Reg";
        }else{
            $uid=getUserTempId();
            $usertype="Not-Reg";
        }
        $result['list']=DB::table('cart')
            ->leftJoin('products','products.id','=','cart.product_id')
            ->leftJoin('product_attr','product_attr.id','=','cart.product_attr_id')
            ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftJoin('colores','colores.id','=','product_attr.color_id')
            ->where(['userid'=>$uid])
            ->where(['usertype'=>$usertype])
            ->select('cart.qty','products.name','products.image','sizes.size','colores.color','product_attr.price','products.slug','products.id as pid','product_attr.id as attr_id')
            ->get();
        return view('front.cart',$result);
    }

    public function search(Request $request, $str){
       
            $query=DB::table('products');
            $query=$query->leftJoin('categories','categories.id','=','products.category_id');
            $query=$query->leftJoin('product_attr','products.id','=','product_attr.product_id');
            $query=$query->where(['products.status'=>1]);
            $query=$query->where('name','like',"%$str%");
            $query=$query->orwhere('brand','like',"%$str%");
            $query=$query->orwhere('model','like',"%$str%");
            $query=$query->orwhere('short_desc','like',"%$str%");
            $query=$query->orwhere('desc','like',"%$str%");
            $query=$query->orwhere('keywords','like',"%$str%");
            $query=$query->orwhere('technical_specification','like',"%$str%");
            $query=$query->distinct()->select('products.*');
            $query=$query->get();
            $result['product']=$query;
            
            foreach($result['product'] as $list1){
               
                $query1=DB::table('product_attr');
                $query1=$query1->leftJoin('sizes','sizes.id','=','product_attr.size_id');
                $query1=$query1->leftJoin('colores','colores.id','=','product_attr.color_id');
                $query1=$query1->where(['product_attr.product_id'=>$list1->id]);
                $query1=$query1->get();
    
                $result['product_attr'][$list1->id]=$query1;
    
            }
            
        return view('front.search',$result);
    }

    public function registration(Request $request){
        if($request->session()->has('FRONT_USER_LOGIN')){
            return redirect('/');
        }
        return view('front.registration');
    }

    public function registration_process(Request $request){
        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'email'=>'required|email|unique:customers,email',
            'password' => 'required',
            'mobile'=>'required|digits:10',
        ]);
        if(!$valid->passes()){
            return response()->json(['status'=>'error', 'error'=>$valid->errors()->toArray()]);
        }else{
            $rand_id = rand(111111111, 999999999);
            $arr=[
             "name"=>$request->name,
             "email"=>$request->email,
             "password"=>Crypt::encrypt($request->password),
             "mobile"=>$request->mobile,
             "status"=>1,
             "is_verify"=>0,
             "rand_id"=>$rand_id,
             "created_at"=>date('Y-m-d h:i:s'),
             "updated_at"=>date('Y-m-d h:i:s'),
            ];

            $query = DB::table('customers')->insert($arr);
            if($query){
                return response()->json(['status'=>'success', 'msg'=>'Registration Successfully. Please check your email id for verification']);
            }
        }
    }

    public function login_process(Request $request){
            // prx($_POST);
            $result=DB::table('customers')
            ->where(['email'=>$request->email_login])
            ->get();  
            if(isset($result[0])){
                $db_pwd=Crypt::decrypt($result[0]->password);
                $status = $result[0]->status;
                $is_verify = $result[0]->is_verify;
                if($is_verify == 0){
                    return response()->json(['status'=>'error', 'msg'=>'Please Verify Your Email']);
                }
                if($status == 0){
                    return response()->json(['status'=>'error', 'msg'=>'Your Account has Deactivated']);
                }
                if($db_pwd == $request->password_login){
                    if($request->rememberme===null){
                        setcookie('login_email',$request->email_login, 100);
                        setcookie('login_password',$request->password_login, 100);
                    }else{
                        setcookie('login_email',$request->email_login, time()+60*60*24*365);
                        setcookie('login_password',$request->password_login, time()+60*60*24*365);
                    }
                     $request->session()->put('FRONT_USER_LOGIN', true);
                     $request->session()->put('FRONT_USER_NAME', $result[0]->name);
                     $request->session()->put('FRONT_USER_ID', $result[0]->id);
                    $status="success";
                    $msg="Registration Successfully";
                    $getUserTempId = getUserTempId();
                    DB::table('cart')
                    ->where(['userid'=>$getUserTempId, 'usertype'=>'Not-Reg'])
                    ->update(['userid'=>$result[0]->id, 'usertype'=>'Reg']);
                }else{
                    $status="error";
                    $msg="Please enter valid password";
                }
            }else{
                $status="error";
                $msg="Please enter valid email Id";
            }
                return response()->json(['status'=>$status, 'msg'=>$msg]);
        
    }

    public function email_verification(Request $request, $id){
        $result=DB::table('customers')
        ->where(['rand_id'=>$id])
        ->get(); 
        if(isset($result[0])){
            $result=DB::table('customers')
        ->where(['id'=>$result[0]->id])
        ->update(['is_verify'=>1, 'rand_id'=>'']);
        return view('front.verification');
        }else{
           return redirect("/");
        }
    }

    public function forgot_password(Request $request){
       $forgot_email = $request->email_forgot;
       $result=DB::table('customers')
            ->where(['email'=>$forgot_email])
            ->get();
            $rand_id = rand(111111111, 999999999);
            if(isset($result[0])){
                $results=DB::table('customers')
                ->where(['email'=>$forgot_email])
                ->update(['is_forgot'=>1, 'rand_id'=>$rand_id]);
                $name = $result[0]->name;
                $data=['rand_id'=>$rand_id, 'name'=>$name];
                $user['to']=$request->email_forgot;
                Mail::send('front.forgot_email', $data, function($message) use ($user){
                  $message->to($user['to']);
                  $message->subject('Forgot Password');
                });
                return response()->json(['status'=>'success', 'msg'=>'Please check your email id for change password']);

            }else{
                return response()->json(['status'=>'error', 'msg'=>'Your Email Id Not Register']);
            }
    }

    public function forgot_password_change(Request $request, $id){
        $result=DB::table('customers')
        ->where(['rand_id'=>$id])
        ->where(['is_forgot'=>1])
        ->get(); 
        if(isset($result[0])){
            $request->session()->put('FORGOT_PASSWORD_UPDATE', $result[0]->id);
        return view('front.forgot_password_change');
        }else{
           return redirect("/");
        }
    }

    public function forgot_password_process(Request $request){
        $results=DB::table('customers')
                ->where(['id'=>$request->session()->get('FORGOT_PASSWORD_UPDATE')])
                ->update(
                    [
                        'is_forgot'=>0,
                        'password'=>Crypt::encrypt($request->password),
                        'rand_id'=>''
                      ]
                    );
                    return response()->json(['status'=>'success', 'msg'=>'Password Change Successfully']);
    }

    public function checkout(Request $request){
        $result['cart_data'] = getAddToCartTotalItem();
        // prx($result);
        if(isset($result['cart_data'][0])){
            if($request->session()->has('FRONT_USER_LOGIN')){
                $uid=$request->session()->get('FRONT_USER_ID');
                $result['customer_data']=DB::table('customers')
                ->where(['id'=>$uid])
                ->get();
                $result['customer_data']['name']=$result['customer_data'][0]->name;
                $result['customer_data']['email']=$result['customer_data'][0]->email;
                $result['customer_data']['mobile']=$result['customer_data'][0]->mobile;
                $result['customer_data']['address']=$result['customer_data'][0]->address;
                $result['customer_data']['state']=$result['customer_data'][0]->state;
                $result['customer_data']['city']=$result['customer_data'][0]->city;
                $result['customer_data']['zip']=$result['customer_data'][0]->zip;
            }else{
                $result['customer_data']['name']='';
                $result['customer_data']['email']='';
                $result['customer_data']['mobile']='';
                $result['customer_data']['address']='';
                $result['customer_data']['state']='';
                $result['customer_data']['city']='';
                $result['customer_data']['zip']='';
            }
        return view('front.checkout', $result);
        }else{
           return redirect("/");
        }
    }

    public function apply_coupon_code(Request $request){
        $arr=apply_coupon_code($request->coupon_code);
        $arr = json_decode($arr, true); 
        return response()->json(['status'=>$arr['status'], 'msg'=>$arr['msg'], 'amount'=>$arr['amount']]);
    }

    public function remove_coupon_code(Request $request){
        $getAddToCartTotalItem = getAddToCartTotalItem();
        $totalPrice = 0;
        foreach($getAddToCartTotalItem as $list){
           $totalPrice = $totalPrice+($list->qty * $list->price);
        }
        return response()->json(['status'=>'success', 'msg'=>'Remove Coupon Code', 'amount'=>$totalPrice]);

    }
    public function place_order_detail(Request $request){
        $payment_url = '';
        $coupon_value=0; 
        if($request->session()->has('FRONT_USER_LOGIN')){

        }else{
            $valid = Validator::make($request->all(),[
                'email'=>'required|email|unique:customers,email'
            ]);
            if(!$valid->passes()){
                return response()->json(['status'=>'error', 
                 'msg'=>"The email has already been taken"]);
            }else{
                $rand_id = rand(111111111, 999999999);
                $arr=[
                 "name"=>$request->name,
                 "email"=>$request->email,
                 "address"=>$request->address,
                 "city"=>$request->city,
                 "state"=>$request->state,
                 "zip"=>$request->zip,
                 "password"=>Crypt::encrypt($rand_id),
                 "mobile"=>$request->mobile,
                 "rand_id"=>$rand_id,
                 "status"=>1,
                 "is_verify"=>0,
                 "created_at"=>date('Y-m-d h:i:s'),
                 "updated_at"=>date('Y-m-d h:i:s'),
                 "is_forgot"=>0
                ];
    
              $user_id = DB::table('customers')->insertGetId($arr);
              $request->session()->put('FRONT_USER_LOGIN', true);
              $request->session()->put('FRONT_USER_NAME', $request->name);
              $request->session()->put('FRONT_USER_ID', $user_id);
              $getUserTempId = getUserTempId();
              DB::table('cart')
              ->where(['userid'=>$getUserTempId, 'usertype'=>'Not-Reg'])
              ->update(['userid'=>$user_id, 'usertype'=>'Reg']);

             
            } 
        }
            if($request->coupon_code != ''){
                $arr=apply_coupon_code($request->coupon_code);
                $arr = json_decode($arr, true);
                
                if($arr['status']=='success'){
                    $coupon_value =$arr['coupon_code_value'];
                }else{
                return response()->json(['status'=>'false', 'msg'=>$arr['msg']]);
                }
            }
            $uid=$request->session()->get('FRONT_USER_ID');
            $totalPrice=0;
            $getAddToCartTotalItem = getAddToCartTotalItem();
            
            foreach($getAddToCartTotalItem as $list){
              $totalPrice = $totalPrice+($list->qty * $list->price);
            }
            
            $arr=[
                "customers_id"=>$uid,
                "name"=>$request->name,
                "email"=>$request->email,
                "mobile"=>$request->mobile,
                "address"=>$request->address,
                "city"=>$request->city,
                "state"=>$request->state,
                "pincode"=>$request->zip,
                "coupon_code"=>$request->coupon_code,
                "coupon_value"=>$coupon_value,
                "order_status"=>1,
                "payment_type"=>$request->payment_type,
                "payment_status"=>"Pending",
                "total_amount"=>$totalPrice,
                "added_on"=>date('Y-m-d h:i:s'),
               ];
   
               $order_id = DB::table('orders')->insertGetId($arr);
               if($order_id>0){
                foreach($getAddToCartTotalItem as $list){
                    $productArr['orders_id']=$order_id;
                    $productArr['product_id']=$list->pid;
                    $productArr['product_attr_id']=$list->attr_id;
                    $productArr['price']=$list->price;
                    $productArr['qty']=$list->qty;
                    DB::table('order_details')->insert($productArr);
                  }

                  if($request->payment_type== 'Gateway'){
                    $final_amt = $totalPrice-$coupon_value;
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, 
                    array("X-Api-Key:test_e8a270beba2f24254affaf8e1d9",
                        "X-Auth-Token:test_76e8e287f4d14b8f330531d80ab"));
                    $payload = Array(
                    'purpose' => 'Buy Product',
                    'amount' => $final_amt,
                    'phone' => $request->mobile,
                    'buyer_name' => $request->name,
                    'redirect_url' => 'http://127.0.0.1:8000/instamojo_submit',
                    'send_email' => true,
                    'send_sms' => true,
                    'email' => $request->email,
                    'allow_repeated_payments' => true
                    );

                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,  http_build_query($payload));
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $response = json_decode($response);
                    if(isset($response->payment_request->id)){
                        $tnx_id = $response->payment_request->id;
                        DB::table('orders')
                        ->where(['id'=>$order_id])
                        ->update(['tnx_id'=>$tnx_id]);
                        $payment_url = $response->payment_request->longurl;
                    }else{
                        $msg ='';
                        foreach($response->message as $key=>$value){
                            $msg .= $key.": ".$value[0].'<br />';
                        } 
                        return response()->json(['status'=>'error', 'msg'=>$msg, 'payment_url'=>'']);
                    }
                    
                  }
                  DB::table('cart')->where(['userid'=>$uid, 'usertype'=>'Reg'])->delete();
                  $request->session()->put('ORDER_ID', $order_id);

                  $status = 'success';
                  $msg='Order placed';
               }else{
                $status = 'false';
                $msg='Please try after some time';
               }
        
        return response()->json(['status'=>$status, 'msg'=>$msg, 'payment_url'=>$payment_url]);
    }
    public function order_place(Request $request){
       if($request->session()->has('ORDER_ID')){
          return view('front.order_place');
       }else{
        return redirect('/');
       }
    }

    public function instamojo_submit(Request $request){
       if($request->get('payment_id')!==null && $request->get('payment_status')!==null && $request->get('payment_request_id')!==null){
          if ($request->get('payment_status') == 'Credit') {
             $p_status ='Success'; 
             $redirect_url = '/order_place';
          } else {
            $p_status ='Fail'; 
            $redirect_url = '/order_fail';
          }

          $request->session()->put('ORDER_STATUS', $p_status);
          DB::table('orders')
          ->where(['tnx_id'=>$request->get('payment_request_id')])
          ->update(['payment_status'=>$p_status,'payment_id'=>$request->get('payment_id')]);
          return redirect($redirect_url);
       }else{
           die('Somethig went wrong');
       }
    }
   
    public function my_order(Request $request){
         $result['orders']= DB::table('orders')
         ->select('orders.*', 'order_status.order_status')
         ->leftjoin('order_status', 'order_status.id', '=', 'orders.order_status')
         ->where(['customers_id' =>$request->session()->get('FRONT_USER_ID')])
         ->get();
        return view('front.order', $result);
    }

    public function order_detail(Request $request, $id){
        $result['order_details']= DB::table('order_details')
        ->select('orders.*', 'order_details.price', 'order_details.qty', 'products.name as pname', 'product_attr.att_image', 'sizes.size', 'colores.color', 'order_status.order_status')
        ->leftjoin('orders', 'orders.id', '=', 'order_details.orders_id')
        ->leftjoin('product_attr', 'product_attr.id', '=', 'order_details.product_attr_id')
        ->leftjoin('products', 'products.id', '=', 'product_attr.product_id')
        ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
        ->leftJoin('colores','colores.id','=','product_attr.color_id')
        ->leftjoin('order_status', 'order_status.id', '=', 'orders.order_status')
        ->where(['orders.id' =>$id])
        ->where(['orders.customers_id' =>$request->session()->get('FRONT_USER_ID')])
        ->get();
       if(!isset($result['order_details'][0])){
        return redirect('/');
       }
        return view('front.order_detail', $result);

   }
    
}

?>
