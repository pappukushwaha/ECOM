@extends('front/layout')
@section('page_title','Category')
@section('container')

  <!-- product category -->
<section id="aa-product-category">
   <div class="container">
      <div class="row">
         <br><br><br>
         <h2><a href="/">Your Order has placed</a></h2>
           <h3>Order Id :- {{session()->get('ORDER_STATUS')}}</h3>
         <br><br><br>
      </div>
   </div>
</section>
<!-- / product category -->

@endsection