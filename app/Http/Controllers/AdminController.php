<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash; 

class AdminController extends Controller
{
   public function index(){
    return view('admin_login/login');
   }

  public function auth(Request $res){
   $email = $res->post('email');
   $pass = $res->post('password');
   $result = Admin::where(['email'=>$email])->first();
   if($result){
      if (Hash::check($pass, $result->password)) {
      $res->session()->put('ADMIN_ID', $result->id);
      return redirect('dashboard');
     }else{
      $res->session()->flash('error', 'Do not Match Email and hash Password');
      return redirect('admin');
     }
      
   }else{
      $res->session()->flash('error', 'Do not Match Email and Password');
      return redirect('admin');
   }

   
  }

  public function register(){
   return view('admin_login/register');
  }

  public function store(Request $request){
   $reg = new Admin();
   $request->validate([
      'email' => 'required|unique:admin',
      'username' => 'required',
      'password' => 'required',
  ]);
   $reg->username = $request->post('username');
   $reg->email = $request->post('email');
   $reg->password = Hash::make($request->post('password'));
   if($reg->save()){
      return redirect('/admin');
   }
  }
}
