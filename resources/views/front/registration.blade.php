@extends('front/layout')
@section('page_title','Registration')
@section('container')

<section id="aa-myaccount">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
       <div class="aa-myaccount-area">         
           <div class="row">
             <div class="col-md-6">
               <div class="aa-myaccount-register">                 
                <h4>Register</h4>
                <form action="" class="aa-login-form" id="frmregistration" >
                   <label for="">Name<span>*</span></label>
                   <input type="text" class="form-control" name="name"  placeholder="Name">
                   <p class="errorrs"><span id="name_error" class="field_error"></span></p>
                   <label for="">Email<span>*</span></label>
                   <input type="email" class="form-control" name="email"  placeholder="Email">
                   <p class="errorrs"><span id="email_error" class="field_error"></span></p>

                   <label for="">Password<span>*</span></label>
                   <input type="password" class="form-control" name="password" placeholder="Password">
                   <p class="errorrs"><span id="password_error" class="field_error"></span></p>

                   <label for="">Mobile<span>*</span></label>
                   <input type="number" class="form-control" name="mobile" placeholder="Mobile">
                   <p class="errorrs"><span id="mobile_error" class="field_error"></span></p>

                   @csrf
                   <button type="submit" id="btnregistration" class="aa-browse-btn">Register</button>  
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