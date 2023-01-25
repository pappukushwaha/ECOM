<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupons;

class CouponControll extends Controller
{
    public function index(){
        $result['data']=Coupons::All();
        return view('admin_login/coupon', $result);
      }
      public function coupon_add(){
        return view('admin_login/coupon_add');
      }
       public function insert(Request $request){
          $request->validate([
            'coupon_tittle'=>'required',
            'coupon_value'=>'required',
            'coupon_code'=>'required|unique:coupons',
          ]);
          $model = new Coupons();
          $model->coupon_tittle = $request->post('coupon_tittle');
          $model->coupon_code = $request->post('coupon_code');
          $model->coupon_value = $request->post('coupon_value');
          $model->status = 1;
          if($model->save()){
            return redirect('/coupon');
          }else{
            return redirect('/coupon_add');
    
          }
       }
       
       public function update($id){
        $result['data']=Coupons::find($id);
        return view('admin_login/coupon_update', $result);
       }
    
       public function delete($id){
           $delete = Coupons::find($id)->delete();
           return redirect('/coupon');
       }
       public function updatedata(Request $request, $id){
        $request->validate([
            'coupon_tittle'=>'required',
            'coupon_value'=>'required',
            'coupon_code'=>'required|unique:coupons,coupon_code,'.$id,
          ]);
          $model = Coupons::find($id);
          $model->coupon_tittle = $request->post('coupon_tittle');
          $model->coupon_code = $request->post('coupon_code');
          $model->coupon_value = $request->post('coupon_value');
          if($model->save()){
            return redirect('/coupon');
          }else{
            return redirect('/coupon_add');
    
          }
       }
       public function status($status, $id){
        $model = Coupons::find($id);
        $model->status = $status;
        $model->save();
        return redirect('/coupon');
    }
}
