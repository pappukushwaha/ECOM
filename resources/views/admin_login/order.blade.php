@extends('admin_login.index')
@section('tittle', 'Order Detail')
@section('order_selected', 'active')
@section('content')
<h1>Order</h1>
<div class="col-md-12 mt-5">
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Customer Details</th>
                    <th>Amt</th>
                    <th>Order Status</th>
                    <th>payment Status</th>
                    <th>payment Type</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $item)
                <tr>
                    <td> <a href="admin_login/order_detail/{{$item->id}}">{{$item->id}}</a> </td>
                    <td>
                        {{$item->name}} <br>
                        {{$item->email}} <br>
                        {{$item->mobile}} <br>
                        {{$item->address}},
                        {{$item->city}},
                        {{$item->state}},
                        {{$item->pincode}}
                    </td>
                    <td> <b>₹</b> {{$item->total_amount}}</td>
                    <td>{{$item->order_status}}</td>
                    <td>{{$item->payment_status}}</td>
                    <td>{{$item->payment_type}}</td>
                    <td>{{$item->added_on}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE-->
</div>
@stop