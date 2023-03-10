@extends('front/layout')
@section('page_title','Forgot Password')
@section('container')

<section id="aa-myaccount">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <div class="aa-myaccount-area">         
           <div class="row">
             <div class="col-md-6">
               <div class="aa-myaccount-register">                 
                <h4>Change Password</h4>
                <form action="" class="aa-login-form" id="frmupdatepassword" >
                   <label for="">Password<span>*</span></label>
                   <input type="password" class="form-control" name="password" placeholder="Password">
                   <p class="errorrs"><span id="password_update_error" class="field_error"></span></p>
                   @csrf
                   <button type="submit" id="btnupdatepassword" class="aa-browse-btn">Update</button>  
                  </form>
                </div>
                <p class="errorrs"><span id="success_reg_msg" class="field_error"></span></p>
             </div>
           </div>          
        </div>
      </div>
    </div>
  </div>
</section>

@endsection