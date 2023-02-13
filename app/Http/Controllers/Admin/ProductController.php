<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductController extends Controller
{
    public function index(){
        $result['data']=Product::All();
        return view('admin_login/product', $result);
      }
      public function product_add(){
        $users['data'] = DB::select('select * from categories where status = 1');
        $users['brand'] = DB::select('select * from brands where status = 1');
        $users['size'] = DB::select('select * from sizes where status = 1');
        $users['color'] = DB::select('select * from colores where status = 1');
        $users['tax'] = DB::select('select * from taxs where status = 1');
        return view('admin_login/product_add', $users);
      }
       public function insert(Request $request){       
        // echo "<pre>";
        // print_r($request->post());
        // die();
        $model = new Product();

          $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:Products',
            'category'=>'required',
            'image'=>'required',
            'brand'=>'required',
            'model'=>'required',
            'short_desc'=>'required',
            'desc'=>'required',
            'keywords'=>'required',
            'technical_specification'=>'required',
            'uses'=>'required',
            'warranty'=>'required',
            'sku' => 'required|unique:product_attr',
          ]);

         

        
          // $skuArr = $request->post('sku');
          // foreach ($skuArr as $key => $value) {
          //   $check = DB::table('product_attr')->
          //   where('sku', '=',$skuArr[$key])->
          //   get();
          //   if(isset($check[0])){
          //     $request->session()->flash('sku_error', $skuArr[$key].'Sku already used');
          //     return redirect(request()->headers->get('referer'));
          //   }
          // }
          

          if($request->hasfile('image')){
            
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
           $model->image = $image_name;

          }
        

          $model->name = $request->post('name');
          $model->slug = $request->post('slug');
          $model->category_id = $request->post('category');
          $model->brand = $request->post('brand');
          $model->model = $request->post('model');
          $model->short_desc = $request->post('short_desc');
          $model->desc = $request->post('desc');
          $model->keywords = $request->post('keywords');
          $model->technical_specification = $request->post('technical_specification');
          $model->uses = $request->post('uses');
          $model->warranty = $request->post('warranty');
          $model->leed_time = $request->post('leed_time');
          $model->tax_id = $request->post('tax_desc');
          $model->is_promo = $request->post('is_promo');
          $model->is_featured = $request->post('is_featured');
          $model->is_descounted = $request->post('is_descounted');
          $model->is_trending = $request->post('is_trending');
          $model->status = 1;
          if($model->save()){
           $pid = $model->id;
           

              /*product attribute start*/
          $skuArr = $request->post('sku');
          $mrpArr = $request->post('mrp');
          $priceArr = $request->post('price');
          $qtyArr = $request->post('qty');
          $size_idArr = $request->post('size_id');
          $color_idArr = $request->post('color_id');
          foreach ($skuArr as $key => $value) {
            $productAttArr['product_id'] = $pid;
            $productAttArr['sku'] =$skuArr[$key];
            $productAttArr['mrp'] =$mrpArr[$key];
            $productAttArr['price'] =$priceArr[$key];
            $productAttArr['qty'] =$qtyArr[$key];
            if($size_idArr[$key] == ''){
              $productAttArr['size_id'] =0;
            }else{
            $productAttArr['size_id'] =$size_idArr[$key];
            }
            if ($color_idArr[$key] == '') {
              $productAttArr['color_id'] =0;
            }else{
            $productAttArr['color_id'] =$color_idArr[$key];
            }

            if ($request->hasFile("att_image.$key")) {
              $rand = rand('11111111','99999999');
              $att_image = $request->file("att_image.$key");
              $ext=$att_image->extension();
              $att_image_name = $rand.'.'.$ext;
              $request->file("att_image.$key")->storeAs('/public/media',$att_image_name);
              $productAttArr['att_image']=$att_image_name;
            }

            DB::table('product_attr')->insert($productAttArr);
          }
          /*product attribute end*/


          /*product images start*/

          $piid = $request->post('piid');
          foreach ($piid as $key => $value) {
            if ($request->hasFile("product_image.$key")) {
              $rand = rand('11111111','99999999');
              $att_image = $request->file("product_image.$key");
              $ext=$att_image->extension();
              $att_image_name = $rand.'.'.$ext;
              $request->file("product_image.$key")->storeAs('/public/media',$att_image_name);
              $productImgArr['product_image']=$att_image_name;
              
            }
            $productImgArr['product_id'] = $pid;
            DB::table('product_images')->insert($productImgArr);
          }


          /*product images end*/
            return redirect('/product');
          }else{
            return redirect('/product_add');
    
          }
       }
       
       public function update($id){
        $result['data']=Product::find($id);
        $result['category'] = DB::select('select * from categories where status = 1');
        $result['brand'] = DB::select('select * from brands where status = 1');
        $result['size'] = DB::select('select * from sizes where status = 1');
        $result['color'] = DB::select('select * from colores where status = 1');
        $result['product_attr'] = DB::select('select * from product_attr where product_id = '.$id);
        $result['product_images'] = DB::select('select * from product_images where product_id = '.$id);
        $result['tax'] = DB::select('select * from taxs where status = 1');
        return view('admin_login/product_update', $result);
       }
    
       public function delete($id){
          $arrImg = DB::table('Products')->where('id','=',$id)->get();
          $arrImgs = DB::table('product_images')->where('product_id','=',$id)->get();
          $arrImgatt = DB::table('product_attr')->where('product_id','=',$id)->get();
           $imgPath = $arrImg[0]->image;
           $imgPaths = $arrImgs;

           for ($i=0; $i < count($arrImgatt); $i++) { 
            Storage::delete('public/media/'.$arrImgatt[$i]->att_image);
            }

            for ($i=0; $i < count($imgPaths); $i++) { 
            Storage::delete('public/media/'.$imgPaths[$i]->product_image);
            }
          Storage::delete('public/media/'.$imgPath);
           $delete = Product::find($id)->delete();
          DB::delete('delete from product_attr where product_id = '.$id);
          DB::delete('delete from product_images where product_id = '.$id);
           return redirect('/product');
       }

       public function deleteattr($pattr, $pid){
        DB::delete('delete from product_attr where id = '.$pattr);
        return redirect('/product_update/'.$pid);
        }

       public function deleteimg($piid, $pid){
       DB::delete('delete from product_images where id = '.$piid);
       return redirect('/product_update/'.$pid);
      }
    
       
       public function updatedata(Request $request, $id){
        // echo "<pre>";
        // print_r($request->all());
        // die();
        $model = Product::find($id);
        $request->validate([
            'name'=>'required',
            'slug'=>'required|unique:Products,slug,'.$id,
            'category'=>'required',
            // 'image'=>'required',
            'brand'=>'required',
            'model'=>'required',
            'short_desc'=>'required',
            'desc'=>'required',
            'keywords'=>'required',
            'technical_specification'=>'required',
            'uses'=>'required',
            'warranty'=>'required',
        ]);
        if($request->hasfile('image')){
          $arrImg = DB::table('Products')->where('id','=',$id)->get();
          $imgPath = $arrImg[0]->image;
          Storage::delete('public/media/'.$imgPath);
            $image=$request->file('image');
            $ext=$image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image = $image_name;
        }

          $model->name = $request->post('name');
          $model->slug = $request->post('slug');
          $model->category_id = $request->post('category');
          $model->brand = $request->post('brand');
          $model->model = $request->post('model');
          $model->short_desc = $request->post('short_desc');
          $model->desc = $request->post('desc');
          $model->keywords = $request->post('keywords');
          $model->technical_specification = $request->post('technical_specification');
          $model->uses = $request->post('uses');
          $model->warranty = $request->post('warranty');
          $model->leed_time = $request->post('leed_time');
          $model->tax_id = $request->post('tax_desc');
          $model->is_promo = $request->post('is_promo');
          $model->is_featured = $request->post('is_featured');
          $model->is_descounted = $request->post('is_descounted');
          $model->is_trending = $request->post('is_trending');
          if($model->save()){
            $pid = $model->id;
            $paidArr = $request->post('paid');
            $skuArr = $request->post('sku');
          $mrpArr = $request->post('mrp');
          $priceArr = $request->post('price');
          $qtyArr = $request->post('qty');
          $size_idArr = $request->post('size_id');
          $color_idArr = $request->post('color_id');
          foreach ($skuArr as $key => $value) {
            $productAttArr['product_id'] = $pid;
            $productAttArr['sku'] =$skuArr[$key];
            $productAttArr['mrp'] =$mrpArr[$key];
            $productAttArr['price'] =$priceArr[$key];
            $productAttArr['qty'] =$qtyArr[$key];
            $productAttArr['size_id'] =$size_idArr[$key];
            $productAttArr['color_id'] =$color_idArr[$key];
            DB::table('product_attr')->where(['id'=>$paidArr[$key]])->update($productAttArr);
            if ($paidArr[$key] != '') {
              if ($request->hasFile("att_image.$key")) {
                $arrImgatt = DB::table('product_attr')->where('product_id','=',$id)->get();
                  Storage::delete('public/media/'.$arrImgatt[$key]->att_image);
                $rand = rand('11111111','99999999');
                $att_image = $request->file("att_image.$key");
                $ext=$att_image->extension();
                $att_image_name = $rand.'.'.$ext;
                $request->file("att_image.$key")->storeAs('/public/media',$att_image_name);
                $productAttArr['att_image']=$att_image_name;
                DB::table('product_attr')->where(['id'=>$paidArr[$key]])->update($productAttArr);
              }
             }else{
              if ($request->hasFile("att_image.$key")) {
                $rand = rand('11111111','99999999');
                $att_image = $request->file("att_image.$key");
                $ext=$att_image->extension();
                $att_image_name = $rand.'.'.$ext;
                $request->file("att_image.$key")->storeAs('/public/media',$att_image_name);
                $productAttArr['att_image']=$att_image_name;
              DB::table('product_attr')->insert($productAttArr);
             }
            }
          }

          $piid = $request->post('piid');
          foreach ($piid as $key => $value) {
          if ($piid[$key] != '') {
            $productImgArr['product_id'] = $pid;
            if ($request->hasFile("product_image.$key")) {
              $arrImgs = DB::table('product_images')->where('product_id','=',$id)->get();
              
              Storage::delete('public/media/'.$arrImgs[$key]->product_image);
      
              $rand = rand('11111111','99999999');
              $att_image = $request->file("product_image.$key");
              $ext=$att_image->extension();
              $att_image_name = $rand.'.'.$ext;
              $request->file("product_image.$key")->storeAs('/public/media',$att_image_name);
              $productImgArr['product_image']=$att_image_name;
              DB::table('product_images')->where(['id'=>$piid[$key]])->update($productImgArr);
            }
           }else{
            if ($request->hasFile("product_image.$key")) {
              $rand = rand('11111111','99999999');
              $att_image = $request->file("product_image.$key");
              $ext=$att_image->extension();
              $att_image_name = $rand.'.'.$ext;
              $request->file("product_image.$key")->storeAs('/public/media',$att_image_name);
              $productImgArr['product_image']=$att_image_name;
            DB::table('product_images')->insert($productImgArr);
           }
          }
          }

            return redirect('/product');
          }else{
            return redirect('/product_add');
    
          }
       }
       public function status($status, $id){
        $model = Product::find($id);
        $model->status = $status;
        $model->save();
        return redirect('/product');
    }
}
