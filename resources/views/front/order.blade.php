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
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Order Id</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                        <th>Total Amt</th>
                        <th>Payment ID</th>
                        <th>Placed At</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($orders as $item)
                      <tr>
                        <td><a href="{{url('/order_detail')}}/{{$item->id}}">{{$item->id}}</a> </td>
                        <td>{{$item->order_status}}</td>
                        <td>{{$item->payment_status}}</td>
                        <td>{{$item->total_amount}}</td>
                        <td>{{$item->payment_id}}</td>
                        <td>{{$item->added_on }}</td>
                      </tr>
                      @endforeach
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