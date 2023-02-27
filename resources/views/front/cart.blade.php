@extends('front.layout')
@section('tittle')
Product Cart Section
@endsection
@section('container')
  <!-- catg header banner section -->
  <section id="cart-view">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="cart-view-area">
            <div class="cart-view-table">
              <form action="">
                @if (isset($list[0]))
                
                <div class="table-responsive">
                   <table class="table">
                     <thead>
                       <tr>
                         <th></th>
                         <th></th>
                         <th>Product</th>
                         <th>Price</th>
                         <th>Quantity</th>
                         <th>Total</th>
                       </tr>
                     </thead>
                     <tbody>
                     @foreach ($list as $data)
                       <tr>
                         <td><a class="remove" href="#"><fa class="fa fa-close"></fa></a></td>
                         <td><a href="{{url('/product/'.$data->slug)}}"><img src="{{asset('storage/media')}}/{{$data->image}}" width="50px" height="50px" style="border-radius: 50%" alt="img"></a></td>
                         <td><a class="aa-cart-title" href="{{url('/product/'.$data->slug)}}">{{$data->name}}</a>
                          <br>SIZE : {{$data->size}}
                          <br>COLOR : {{$data->color}}
                        </td>
                         <td>Rs - {{$data->price}}</td>
                         <td><input class="aa-cart-quantity" type="number" id='updateqty'  value="{{$data->qty}}" onchange="updateqt()"></td>
                         
                         <td>Rs - {{($data->price)*($data->qty)}}</td>
                       </tr>
                       @endforeach
                       <tr>
                         <td colspan="6" class="aa-cart-view-bottom">
                           <div class="aa-cart-coupon">
                             <input class="aa-coupon-code" type="text" placeholder="Coupon">
                             <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                           </div>
                           <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                         </td>
                       </tr>
                       </tbody>
                   </table>
                 </div>
                     
                @endif
              </form>
              <!-- Cart Total view -->
              <div class="cart-view-total">
                <h4>Cart Totals</h4>
                <table class="aa-totals-table">
                  <tbody>
                    <tr>
                      <th>Subtotal</th>
                      <td>$450</td>
                    </tr>
                    <tr>
                      <th>Total</th>
                      <td>$450</td>
                    </tr>
                  </tbody>
                </table>
                <a href="#" class="aa-cart-view-btn">Proced to Checkout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection