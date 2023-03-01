<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Categories;
use Illuminate\Support\Facades\DB;
use Storage;



class CategoryControll extends Controller
{
 
  public function index(){
    $result['data']=Categories::All();
    return view('admin_login/categories', $result);
  }
  public function category_add(){
    $result['data'] = DB::table('Categories')->get();
    return view('admin_login/categories_add', $result);
  }
   public function insert(Request $request){
      $request->validate([
        'category_name'=>'required',
        'category_slug'=>'required|unique:Categories',
      ]);
      $model = new Categories();

      if($request->hasfile('category_image')){
        $image=$request->file('category_image');
        $ext=$image->extension();
        $image_name = time().'.'.$ext;
        $image->storeAs('/public/media',$image_name);
        $model->category_image = $image_name;
      }
      $model->category_name	= $request->post('category_name');
      $model->category_slug = $request->post('category_slug');
      if($request->post('parent_category') == ''){
        $model->parent_category = '0';
      }else{
        $model->parent_category = $request->post('parent_category');
      }
      $model->status = 1;
      if($model->save()){
        return redirect('/category');
      }else{
        return redirect('/category_add');

      }
   }
   
   public function update($id){
    $result['data']=Categories::find($id);
    $result['category'] = DB::table('Categories')->where('id','!=',$id)->get();
    return view('admin_login/categories_update', $result);
   }

   public function delete($id){
      $arrImg = DB::table('Categories')->where('id','=',$id)->get();
       $imgPath = $arrImg[0]->category_image;
       Storage::delete('public/media/'.$imgPath);
       $delete = Categories::find($id)->delete();
       return redirect('/category');
   }
   public function updatedata(Request $request, $id){
    $request->validate([
        'category_name'=>'required',
        'category_slug'=>'required|unique:Categories,category_slug,'.$id,
      ]);
      $model = Categories::find($id);
      if($request->hasfile('category_image')){
        $arrImg = DB::table('Categories')->where('id','=',$id)->get();
       $imgPath = $arrImg[0]->category_image;
       Storage::delete('public/media/'.$imgPath);
        $image=$request->file('category_image');
        $ext=$image->extension();
        $image_name = time().'.'.$ext;
        $image->storeAs('/public/media',$image_name);
        $model->category_image = $image_name;
      }
      $model->category_name	= $request->post('category_name');
      $model->category_slug = $request->post('category_slug');
      if($request->post('parent_category') == ''){
        $model->parent_category = 'null';
      }else{
        $model->parent_category = $request->post('parent_category');
      }
      if($model->save()){
        return redirect('/category');
      }else{
        return redirect('/category_add');

      }
   }

   public function status($status, $id){
    $model = Categories::find($id);
    $model->status = $status;
    $model->save();
    return redirect('/category');
}
}
