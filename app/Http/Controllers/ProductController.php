<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        $result['data']=Product::All();
        return view('admin_login/product', $result);
      }
      public function product_add(){
        $users['data'] = DB::select('select * from categories where status = 1');
        return view('admin_login/product_add', $users);
      }
       public function insert(Request $request){
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
          ]);
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
          $model->status = 1;
          if($model->save()){
            return redirect('/product');
          }else{
            return redirect('/product_add');
    
          }
       }
       
       public function update($id){
        $result['data']=Product::find($id);
        $result['category'] = DB::select('select * from categories where status = 1');

        return view('admin_login/product_update', $result);
       }
    
       public function delete($id){
           $delete = Product::find($id)->delete();
           return redirect('/product');
       }
       public function updatedata(Request $request, $id){
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
          if($model->save()){
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
