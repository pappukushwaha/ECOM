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
      echo "<pre>";
      print_r($result['home_product_attr']);
      echo "</pre>";
    return view('front.index', $result);
   }
   public function fromshow(){

   }
}
