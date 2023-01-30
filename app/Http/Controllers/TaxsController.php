<?php

namespace App\Http\Controllers;

use App\Models\taxs;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class TaxsController extends Controller
{
    public function index(){
        $result['data']=taxs::All();
        return view('admin_login/tax', $result);
      }
      public function tax_add(){
        return view('admin_login/tax_add');
      }
       public function insert(Request $request){
          $request->validate([
            'tax_desc'=>'required',
          ]);
          $model = new taxs();
          $model->tax_desc = $request->post('tax_desc');
          $model->tax_value = $request->post('tax_value');
          $model->status = 1;
          if($model->save()){
            return redirect('/tax');
          }else{
            return redirect('/tax_add');
    
          }
       }
       
       public function update($id){
        $result['data']=taxs::find($id);
        return view('admin_login/tax_update', $result);
       }
    
       public function delete($id){
           $delete = taxs::find($id)->delete();
           return redirect('/tax');
       }
       public function updatedata(Request $request, $id){
        $request->validate([
            'tax_desc'=>'required',
          ]);
          $model = taxs::find($id);
          $model->tax_desc = $request->post('tax_desc');
          $model->tax_value = $request->post('tax_value');
          if($model->save()){
            return redirect('/tax');
          }else{
            return redirect('/tax_add');
    
          }
       }
       public function status($status, $id){
        $model = taxs::find($id);
        $model->status = $status;
        $model->save();
        return redirect('/tax');
    }
}
