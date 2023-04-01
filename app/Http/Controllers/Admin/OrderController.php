<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function index(Request $request){
      $result['orders']= DB::table('orders')
         ->select('orders.*', 'order_status.order_status')
         ->leftjoin('order_status', 'order_status.id', '=', 'orders.order_status')
         ->get();
        return view('admin_login.order', $result);
    }

    public function order_detail(Request $request, $id){
      $result['order_details']= DB::table('order_details')
      ->select('orders.*', 'order_details.price', 'order_details.qty', 'products.name as pname', 'product_attr.att_image', 'sizes.size', 'colores.color', 'order_status.order_status')
      ->leftjoin('orders', 'orders.id', '=', 'order_details.orders_id')
      ->leftjoin('product_attr', 'product_attr.id', '=', 'order_details.product_attr_id')
      ->leftjoin('products', 'products.id', '=', 'product_attr.product_id')
      ->leftJoin('sizes','sizes.id','=','product_attr.size_id')
      ->leftJoin('colores','colores.id','=','product_attr.color_id')
      ->leftjoin('order_status', 'order_status.id', '=', 'orders.order_status')
      ->where(['orders.id' =>$id])
      ->get();

      $result['payment_status'] = ['pending', 'success', 'fail'];
     
      $result['order_status'] = DB::table('order_status')->get();



      return view('admin_login.order_detail', $result);
 }

 public function payment_status_update(Request $request, $status, $id){
  DB::table('orders')
  ->where(['id'=>$id])
  ->update(['payment_status'=>$status]);
  return redirect('admin_login/order_detail/'.$id);
 }

 public function order_status_update(Request $request, $status, $id){
  DB::table('orders')
  ->where(['id'=>$id])
  ->update(['order_status'=>$status]);
  return redirect('admin_login/order_detail/'.$id);
 }

 public function track_update(Request $request, $id){
  $track_detail = $request->post('track_detail');
  DB::table('orders')
  ->where(['id'=>$id])
  ->update(['track_detail'=>$track_detail]);
  return redirect('admin_login/order_detail/'.$id);
 }

}
