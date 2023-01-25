<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;


class CategoryControll extends Controller
{
 
  public function index(){
    $result['data']=Categories::All();
    return view('admin_login/categories', $result);
  }
  public function category_add(){
    return view('admin_login/categories_add');
  }
   public function insert(Request $request){
      $request->validate([
        'category_name'=>'required',
        'category_slug'=>'required|unique:Categories',
      ]);
      $model = new Categories();
      $model->category_name	= $request->post('category_name');
      $model->category_slug = $request->post('category_slug');
      $model->status = 1;
      if($model->save()){
        return redirect('/category');
      }else{
        return redirect('/category_add');

      }
   }
   
   public function update($id){
    $result['data']=Categories::find($id);
    return view('admin_login/categories_update', $result);
   }

   public function delete($id){
       $delete = Categories::find($id)->delete();
       return redirect('/category');
   }
   public function updatedata(Request $request, $id){
    $request->validate([
        'category_name'=>'required',
        'category_slug'=>'required|unique:Categories,category_slug,'.$id,
      ]);
      $model = Categories::find($id);
      $model->category_name	= $request->post('category_name');
      $model->category_slug = $request->post('category_slug');
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
