<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class BrandController extends Controller
{
    
  public function index(){
    $result['data']=Brand::All();
    return view('admin_login/brand', $result);
  }
  public function brand_add(){
    return view('admin_login/brand_add');
  }
   public function insert(Request $request){
      $request->validate([
        'brand_img'=>'required',
        'brand'=>'required|unique:brands',
      ]);
      $model = new Brand();
      $model->brand	= $request->post('brand');
      if($request->hasFile('brand_img')){
        $image=$request->file('brand_img');
        $ext=$image->extension();
        $image_name = time().'.'.$ext;
        $image->storeAs('/public/media',$image_name);
        $model->brand_img = $image_name;
      }
      $model->status = 1;
      if($model->save()){
        return redirect('/brand');
      }else{
        return redirect('/brand_add');
      }
   }
   
   public function update($id){
    $result['data']=Brand::find($id);
    return view('admin_login/brand_update', $result);
   }

   public function delete($id){
    $arrImg = DB::table('brands')->where('id','=',$id)->get();
       $imgPath = $arrImg[0]->brand_img;
       Storage::delete('public/media/'.$imgPath);
       $delete = Brand::find($id)->delete();
       return redirect('/brand');
   }
   public function updatedata(Request $request, $id){
    $request->validate([
        'brand'=>'required|unique:brands,brand,'.$id,
      ]);
      $model = Brand::find($id);
      if($request->hasFile('brand_img')){
        $image=$request->file('brand_img');
        $ext=$image->extension();
        $image_name = time().'.'.$ext;
        $image->storeAs('/public/media',$image_name);
        $model->brand_img = $image_name;
      }
      $model->brand	= $request->post('brand');
      if($model->save()){
        return redirect('/brand');
      }else{
        return redirect('/brand_update');

      }
   }

   public function status($status, $id){
    $model = Brand::find($id);
    $model->status = $status;
    $model->save();
    return redirect('/brand');
   }
}
