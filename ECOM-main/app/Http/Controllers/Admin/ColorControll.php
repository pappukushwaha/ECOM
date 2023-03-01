<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Colors;


class ColorControll extends Controller
{
    public function index(){
        $result['data']=Colors::All();
        return view('admin_login/color', $result);
      }
      public function color_add(){
        return view('admin_login/color_add');
      }
       public function insert(Request $request){
          $request->validate([
            'color'=>'required|unique:colores',
          ]);
          $model = new Colors();
          $model->color = $request->post('color');
          $model->status = 1;
          if($model->save()){
            return redirect('/color');
          }else{
            return redirect('/color_add');
    
          }
       }
       
       public function update($id){
        $result['data']=Colors::find($id);
        return view('admin_login/color_update', $result);
       }
    
       public function delete($id){
           $delete = Colors::find($id)->delete();
           return redirect('/color');
       }
       public function updatedata(Request $request, $id){
        $request->validate([
            'color'=>'required|unique:colores,color,'.$id,
          ]);
          $model = Colors::find($id);
          $model->color = $request->post('color');
          if($model->save()){
            return redirect('/color');
          }else{
            return redirect('/color_add');
    
          }
       }
       public function status($status, $id){
        $model = Colors::find($id);
        $model->status = $status;
        $model->save();
        return redirect('/color');
    }
}
