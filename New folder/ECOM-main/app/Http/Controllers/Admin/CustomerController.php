<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        $result['customer']=customer::All();
        return view('admin_login/customer', $result);
      }

       public function status($status, $id){
        $model = customer::find($id);
        $model->status = $status;
        $model->save();
        return redirect('/customer');
    }

    public function show($id){
        $result['customer_list']=customer::find($id);
        return view('admin_login/customer_list', $result);

    }
}
