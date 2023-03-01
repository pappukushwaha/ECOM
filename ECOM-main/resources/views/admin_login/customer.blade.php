@extends('admin_login.index')
@section('tittle', 'Customer')
@section('customer_selected', 'active')
@section('content')
<h1>Customer Details</h1>
<div class="col-md-12 mt-5">
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>City</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customer as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->mobile}}</td>
                    <td>{{$item->city}}</td>
                    <td><a href="/customer_show/{{$item->id}}" class="btn btn-success">View</a> 
                    @if ($item->status == 0)
                    <a href="/status_update_customer/1/{{$item->id}}" class="btn btn-primary">Active</a> 
                    @elseif($item->status == 1)
                    <a href="/status_update_customer/0/{{$item->id}}" class="btn btn-warning">Deactive</a>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE-->
</div>
@stop