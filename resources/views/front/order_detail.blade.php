@extends('front/layout')
@section('page_title','Cart Page')
@section('container')

<!-- catg header banner section -->
<section id="aa-catg-head-banner">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->      
  <section id="cart-view">
   <div class="container">
     <div class="row">
      <div class="col-md-6">
        <h3>Details Placed Address</h3>
         <p><b>Name : </b>{{$order_details[0]->name}}</p>
         <p><b>Mobile : </b>{{$order_details[0]->mobile}}</p>
         <p><b>Address : </b>{{$order_details[0]->address}}</p>
         <p><b>City : </b>{{$order_details[0]->city}}</p>
         <p><b>State : </b>{{$order_details[0]->state}}</p>
         <p><b>Pincode : </b>{{$order_details[0]->pincode}}</p>
      </div>
      <div class="col-md-6">
        <h3>Order Details</h3>
        <p><b>Order Status : </b>{{$order_details[0]->order_status}}</p>
        <p><b>Payment Status : </b>{{$order_details[0]->payment_status}}</p>
        <p><b>Payment Type : </b>{{$order_details[0]->payment_type}}</p>
        @php
            if ($order_details[0]->payment_id != '') {
             echo '<p><b>Payment Id : </b>'.$order_details[0]->payment_id.'</p>';
             
            }
        @endphp
               <p><b>Track Detail : </b>{{$order_details[0]->track_detail}}</p>
      </div>
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $total_amt = 0;
                      @endphp
                      @foreach ($order_details as $item)
                      @php
                          $total_amt = $total_amt + $item->price * $item->qty;
                      @endphp
                      <tr>
                        <td>{{$item->pname}}</td>
                        <td><img src="{{asset('storage/media/'.$item->att_image)}}" width="70px" height="100px" alt="Image Not available" /> </td>
                        <td>{{$item->size}}</td>
                        <td>{{$item->color}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->qty}}</td>
                        <td><b>₹ </b> {{$item->price * $item->qty}}</td>
                      </tr>
                      @endforeach
                       <tr>
                        <td colspan="5">&nbsp;</td>
                        <td><b>Total</b></td>
                        <td><b>₹ </b><b>{{$total_amt}}</b></td>
                       </tr>
                       @php
                           if ($order_details[0]->coupon_value > 0) {
                            echo '<tr>
                                    <td colspan="5">&nbsp;</td>
                                    <td><b>Coupon <span style="color:#333;">('.$order_details[0]->coupon_code.')</span></b></td>
                                    <td><b>₹ </b><b>'.$order_details[0]->coupon_value.'</b></td>
                                  </tr>';
                          
                           $totalAmt = $total_amt - $order_details[0]->coupon_value;
                           echo '<tr>
                                    <td colspan="5">&nbsp;</td>
                                    <td><b>Total With Coupon Value</b></td>
                                    <td><b>₹ </b><b>'.$totalAmt.'</b></td>
                                  </tr>';
                          }
                       @endphp
                    </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
           
		   </div>
         </div>
       </div>
     </div>
   </div>
 </section>  
@endsection