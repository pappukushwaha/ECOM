@extends('front/layout')
@section('page_title','CheckOut')
@section('container')

<section id="checkout">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
         <div class="checkout-area">
           <form action="">
             <div class="row">
               <div class="col-md-8">
                 <div class="checkout-left">
                    @if (!session()->has('FRONT_USER_LOGIN'))
                    <p><a href="javascript:void(0)" data-toggle="modal" data-target="#login-modal" class="aa-browse-btn">Login</a></p>
                    <p>OR</p>
                    @endif
                   <div class="panel-group" id="accordion">
                     <div class="panel panel-default aa-checkout-billaddress">
                        <h3 class="" style="color: #ff6666; padding-left:15px">User Details Address</h3>
                       <div id="" class="">
                         <div class="panel-body">
                           <div class="row">
                             <div class="col-md-4">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="Name*" value="{{$customer_data['name']}}" name="name" required>
                               </div>                             
                             </div>
                             <div class="col-md-4">
                               <div class="aa-checkout-single-bill">
                                 <input type="email" placeholder="Email Address*" value="{{$customer_data['email']}}" name="=email" required >
                               </div>                             
                             </div>
                             <div class="col-md-4">
                               <div class="aa-checkout-single-bill">
                                 <input type="tel" placeholder="Phone*" value="{{$customer_data['mobile']}}" name="mobile" required >
                               </div>
                             </div>
                           </div> 
                           <div class="row">
                             <div class="col-md-12">
                               <div class="aa-checkout-single-bill">
                                 <textarea cols="8" rows="3" name="name" required >{{$customer_data['address']}} </textarea>
                               </div>                             
                             </div>                            
                           </div>   
                              
                           <div class="row">
                             <div class="col-md-4">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="City / Town*" value="{{$customer_data['city']}}" name="city" required >
                               </div>
                             </div>
                         
                        
                             <div class="col-md-4">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="State*" value="{{$customer_data['state']}}" name="state" required >
                               </div>                             
                             </div>
                             <div class="col-md-4">
                               <div class="aa-checkout-single-bill">
                                 <input type="text" placeholder="Postcode / ZIP*" value="{{$customer_data['zip']}}" name="zip" required  >
                               </div>
                             </div>
                           </div>                              
                         </div>
                       </div>
                     </div>
                     </div>
                   </div>
                 </div>
               <div class="col-md-4">
                 <div class="checkout-right">
                   <h4>Order Summary</h4>
                   <div class="aa-order-summary-area">
                     <table class="table table-responsive">
                       <thead>
                         <tr>
                           <th>Product</th>
                           <th>Total</th>
                         </tr>
                       </thead>
                       <tbody>
                        @php
                            $totalprice = 0;
                        @endphp
                        @foreach ($cart_data as $item)
                        @php
                            $totalprice = $totalprice+($item->qty * $item->price);
                        @endphp
                         <tr>
                           <td>{{$item->name}} <strong> x  {{$item->qty}}</strong></td>
                           <td>₹ {{$item->qty * $item->price}}</td>
                         </tr>
                         @endforeach
                       </tbody>
                       <tfoot>
                        <tr class="hide coupon_code_box">
                            <th>Coupon Code <a href="javascript:void(0)" onclick="remove_coupon_code()" style="color:red; font-size: 12px;">Remove</a> </th>
                            <td id="coupon_code_show"></td>
                          </tr>
                          <tr>
                           <th>Total</th>
                           <td id="show_total_price">₹ {{$totalprice}}</td>
                         </tr>
                       </tfoot>
                     </table>
                   </div>
                   <div class="panel panel-default aa-checkout-coupon">
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <input type="text" placeholder="Coupon Code" class="apply_coupon_code" name="coupon_code" id="coupon_code" style="border: 1px solid #ccc; height: 40px; padding: 10px; width: 100%;"><br>
                        <br>
                        <input type="button" value="Apply Coupon" class="aa-browse-btns apply_coupon_code" onclick="applycouponcode()">
                        <div id="coupon_code_msg"></div>
                      </div>
                    </div>
                  </div>
                   <h4>Payment Method</h4>
                   <div class="aa-payment-method">                    
                     <label for="cashdelivery"><input type="radio" id="cashdelivery" name="optionsRadios"> Cash on Delivery </label>
                     <label for="paypal"><input type="radio" id="paypal" name="optionsRadios" checked> Via Paypal </label>
                     <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0" alt="PayPal Acceptance Mark">    
                     <input type="submit" value="Place Order" class="aa-browse-btn">                
                   </div>
                 </div>
               </div>
             </div>
             @csrf
           </form>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection