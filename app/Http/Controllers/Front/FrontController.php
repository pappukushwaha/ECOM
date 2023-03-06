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
            $uid=$request->session()->get('FRONT_USER_LOGIN');
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
            $uid=$request->session()->get('FRONT_USER_LOGIN');
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
                $data=['name'=>$request->name, 'rand_id'=>$rand_id];
                $user['to']=$request->email;
                Mail::send('front.email_verification', $data, function($message) use ($user){
                  $message->to($user['to']);
                  $message->subject('Email Id Verification');
                });
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
    
}

?>
