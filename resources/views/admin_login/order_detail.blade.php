@extends('admin_login.index')
@section('tittle', 'Order Detail')
@section('order_selected', 'active')
@section('content')
<h1>Order - {{$order_details[0]->id}}</h1>
<div class="col-md-12 mt-5" style="background: #fff; padding: 30px;">
    <div class="row">
        <div class="col-md-6">
            <label for="update_payment_status"><b>Update Payment Status</b></label>
            <select name="payment_status" id="payment_status" onchange="payment_status({{$order_details[0]->id}})" class="form-control" >
                @php
                    foreach ($payment_status as $value) {
                        if ($value == $order_details[0]->payment_status) {
                        
                            echo '<option value="'.$value.'" selected >'.$order_details[0]->payment_status.'</option>';
                        }else{
                            echo '<option value="'.$value.'">'.$value.'</option>';
                        }
                    }
                @endphp
            </select>
        </div>
        <div class="col-md-6">
            <label for="update_order_status"><b>Update Order Status</b> </label> 
            <select name="order_status" id="order_status" onchange="order_status({{$order_details[0]->id}})" class="form-control" >
            @php
                foreach ($order_status as $value) {
                    if ($value->order_status == $order_details[0]->order_status) {
                        echo '<option value="'.$value->id.'" selected >'.$order_details[0]->order_status.'</option>';
                    }else{
                        echo '<option value="'.$value->id.'">'.$value->order_status.'</option>';
                    }
                }
            @endphp
            </select>
        </div>
    </div>
 
<br>
<form method="post">
<label for="update_order_status"><b>Update Track Detail</b> </label> 

    <textarea name="track_detail" id="track_detail" class="form-control" >{{$order_details[0]->track_detail}}</textarea>
    <input type="submit" value="Update" class="btn btn-danger mt-2">
    @csrf
</form>


</div>
<div class="col-md-12 mt-5" style="background: #fff; padding: 30px;">
    <!-- START DATA TABLE-->
    <div class="table-responsive m-b-40 " >
    <div class="row" >
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
        </div>
         <div class="col-md-12">
           <div class="cart-view-area">
             <div class="cart-view-table">
               <form action="">
                 <div class="table-responsive"> <br>
                    <table class="table table-data3 table table-borderless">
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
    <!-- END DATA TABLE-->
</div>
@stop