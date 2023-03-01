<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Sizes;


class SizeControll extends Controller
{
    public function index(){
        $result['data']=Sizes::All();
        return view('admin_login/size', $result);
      }
      public function size_add(){
        return view('admin_login/size_add');
      }
       public function insert(Request $request){
          $request->validate([
            'size'=>'required',
          ]);
          $model = new Sizes();
          $model->size = $request->post('size');
          $model->status = 1;
          if($model->save()){
            return redirect('/size');
          }else{
            return redirect('/size_add');
    
          }
       }
       
       public function update($id){
        $result['data']=Sizes::find($id);
        return view('admin_login/size_update', $result);
       }
    
       public function delete($id){
           $delete = Sizes::find($id)->delete();
           return redirect('/size');
       }
       public function updatedata(Request $request, $id){
        $request->validate([
            'size'=>'required',
          ]);
          $model = Sizes::find($id);
          $model->size = $request->post('size');
          if($model->save()){
            return redirect('/size');
          }else{
            return redirect('/size_add');
    
          }
       }
       public function status($status, $id){
        $model = Sizes::find($id);
        $model->status = $status;
        $model->save();
        return redirect('/size');
    }
}
