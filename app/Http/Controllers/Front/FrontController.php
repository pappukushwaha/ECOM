<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; 

class FrontController extends Controller
{
   public function index(){
      $result['home_categories']=DB::table('categories')
      ->where(['status'=>1])
      ->get();

      $result['home_banners']=DB::table('home_banners')
      ->where(['status'=>1])
      ->get();

      $result['home_brand']=DB::table('brands')
      ->where(['status'=>1])
      ->get();
      foreach($result['home_categories'] as $lits){
         $result['home_categories_product'][$lits->id]=DB::table('products')
         ->where(['status'=>1])
         ->where(['category_id'=>$lits->id])
         ->get();
         foreach($result['home_categories_product'][$lits->id] as $lits1){
            $result['home_product_attr'][$lits1->id]=DB::table('product_attr')
            ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftjoin('colores','colores.id','=','product_attr.color_id')
            ->where(['product_id'=>$lits1->id])
            ->get();
         }
      }

      $result['home_featured_product'][$lits->id]=DB::table('products')
         ->where(['is_featured'=>1])
         ->where(['status'=>1])
         ->get();
         foreach($result['home_featured_product'][$lits->id] as $lits1){
            $result['home_featured_product_attr'][$lits1->id]=DB::table('product_attr')
            ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftjoin('colores','colores.id','=','product_attr.color_id')
            ->where(['product_id'=>$lits1->id])
            ->get();
         }

         $result['home_trending_product'][$lits->id]=DB::table('products')
         ->where(['is_trending'=>1])
         ->where(['status'=>1])
         ->get();
         foreach($result['home_trending_product'][$lits->id] as $lits1){
            $result['home_trending_product_attr'][$lits1->id]=DB::table('product_attr')
            ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftjoin('colores','colores.id','=','product_attr.color_id')
            ->where(['product_id'=>$lits1->id])
            ->get();
         }

         $result['home_descounted_product'][$lits->id]=DB::table('products')
         ->where(['is_descounted'=>1])
         ->where(['status'=>1])
         ->get();
         foreach($result['home_descounted_product'][$lits->id] as $lits1){
            $result['home_descounted_product_attr'][$lits1->id]=DB::table('product_attr')
            ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftjoin('colores','colores.id','=','product_attr.color_id')
            ->where(['product_id'=>$lits1->id])
            ->get();
         }
         // echo "<pre>";
         // print_r($result);
         // echo "</pre>";
    return view('front.index', $result);
   }
   public function product(Request $request, $slug){
      $result['product']=DB::table('products')
         ->where(['slug'=>$slug])
         ->where(['status'=>1])
         ->get();
         foreach($result['product'] as $lits1){
            $result['product_attr'][$lits1->id]=DB::table('product_attr')
            ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftjoin('colores','colores.id','=','product_attr.color_id')
            ->where(['product_id'=>$lits1->id])
            ->get();
         }
         // echo "<pre>";
         // print_r($result);

         $result['related_product']=DB::table('products')
         ->where('slug','!=',$slug)
         ->where(['status'=>1])
         ->where(['category_id'=>$result['product'][0]->category_id])
         ->get();

         foreach($result['related_product'] as $lits1){
            $result['related_product_attr'][$lits1->id]=DB::table('product_attr')
            ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftjoin('colores','colores.id','=','product_attr.color_id')
            ->where(['product_id'=>$lits1->id])
            ->get();
         }

         foreach($result['product'] as $lits1){
            $result['product_images'][$lits1->id]=DB::table('product_images')
            ->where(['product_id'=>$lits1->id])
            ->get();
         }

      return view("front.product", $result);
   }

   public function add_to_cart(Request $request){
      if($request->session()->has('FRONT_USER_LOGIN')){
         $uid = $request->session()->get('USER_LOGIN');
         $user_type = "Reg";
      }else{
         $uid = getrandomuserid();
         $user_type = "Not-Reg";
      }
      $size_id = $request->post('size_id');
      $color_id = $request->post('color_id');
      $pqty = $request->post('pqty');
      $product_id = $request->post('product_id');
      $result=DB::table('product_attr')
            ->select('product_attr.id')
            ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
            ->leftjoin('colores','colores.id','=','product_attr.color_id')
            ->where(['product_id'=>$product_id])
            ->where(['sizes.size'=>$size_id])
            ->where(['colores.color'=>$color_id])
            ->get();

     $product_attr_id = $result[0]->id;
     $check = DB::table('cart')
     ->where(['userid'=>$uid])
     ->where(['usertype'=>$user_type])
     ->where(['product_id'=>$product_id])
     ->where(['product_attr_id'=>$product_attr_id])
     ->get();
     
     if(isset($check[0])){
      $updated_id = $check[0]->id;
      DB::table('cart')
     ->where(['id'=>$updated_id])
     ->update(['qty'=>$pqty]);
     $msg = "update";
     }else{
      $id = DB::table('cart')->insertGetId([
         'userid'=>$uid,
         'usertype'=>$user_type,
         'product_id'=>$product_id,
         'product_attr_id'=>$product_attr_id,
         'qty'=>$pqty,
         'added_on'=>date('Y-m-d h:i:s')
      ]);
      $msg = "Added On";
     }
     return response()->json(['msg'=>$msg, 'user_id'=>$uid, 'user_type'=>$user_type, 'qty'=>$pqty, 'product_id'=>$product_id, 'product_attr_id'=>$product_attr_id]);
   }

   public function cart(Request $request){
      if($request->session()->has('FRONT_USER_LOGIN')){
         $uid = $request->session()->get('USER_LOGIN');
         $user_type = "Reg";
      }else{
         $uid = getrandomuserid();
         $user_type = "Not-Reg";
      }

     $result['list'] = DB::table('cart')
      ->leftjoin('products','products.id','=','cart.product_id')
      ->leftjoin('product_attr','product_attr.id','=','cart.product_attr_id')
      ->leftjoin('sizes','sizes.id','=','product_attr.size_id')
      ->leftjoin('colores','colores.id','=','product_attr.color_id')
      ->where(['userid'=>$uid])
      ->where(['usertype'=>$user_type])
      ->select('products.name', 'products.image', 'cart.qty', 'sizes.size','colores.color', 'product_attr.price', 'products.slug')
      ->get();
   //  prx($result);

      return view('front.cart', $result);
   }

}
