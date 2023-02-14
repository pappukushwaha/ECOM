<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\HomeBanner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;



class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['data']=HomeBanner::All();
        return view('admin_login/homeBanner', $result);
    }

    public function homeBanner_add(){
        return view('admin_login/homeBanner_add');
      }
       public function insert(Request $request){
       
          $model = new HomeBanner();
    
          if($request->hasfile('homeBanner_image')){
            $image=$request->file('homeBanner_image');
            $ext=$image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image = $image_name;
          }
          $model->btn_txt = $request->post('btn_txt');
          $model->btn_link = $request->post('btn_link');
       
          $model->status = 1;
          if($model->save()){
            return redirect('/homeBanner');
          }else{
            return redirect('/homeBanner_add');
    
          }
       }
       
       public function update($id){
        $result['data']=HomeBanner::find($id);
        return view('admin_login/homeBanner_update', $result);
       }
    
       public function delete($id){
          $arrImg = DB::table('home_banners')->where('id','=',$id)->get();
           $imgPath = $arrImg[0]->image;
           Storage::delete('public/media/'.$imgPath);
           $delete = HomeBanner::find($id)->delete();
           return redirect('/homeBanner');
       }
       public function updatedata(Request $request, $id){
       
          $model = HomeBanner::find($id);
          if($request->hasfile('homeBanner_image')){
            $arrImg = DB::table('home_banners')->where('id','=',$id)->get();
           $imgPath = $arrImg[0]->image;
           Storage::delete('public/media/'.$imgPath);
            $image=$request->file('homeBanner_image');
            $ext=$image->extension();
            $image_name = time().'.'.$ext;
            $image->storeAs('/public/media',$image_name);
            $model->image = $image_name;
          }
          $model->btn_txt = $request->post('btn_txt');
          $model->btn_link = $request->post('btn_link');
        
          if($model->save()){
            return redirect('/homeBanner');
          }else{
            return redirect('/homeBanner_add');
    
          }
       }
    
       public function status($status, $id){
        $model = HomeBanner::find($id);
        $model->status = $status;
        $model->save();
        return redirect('/homeBanner');
    }
}
