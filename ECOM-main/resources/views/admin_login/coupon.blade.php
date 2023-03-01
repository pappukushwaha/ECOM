@extends('admin_login.index')
@section('tittle', 'Coupon')
@section('coupon_selected', 'active')
@section('content')
<h1>Category Manage</h1>
<h3 class="mt-3"><a href="coupon_add" class="btn btn-primary">+ Add Coupon</a></h3>
<div class="col-md-12 mt-5">
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Coupon Tittle</th>
                    <th>Coupon Code</th>
                    <th>Coupon Value</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->coupon_tittle}}</td>
                    <td>{{$item->coupon_code}}</td>
                    <td>{{$item->coupon_value}}</td>
                    <td><a href="/coupon_update/{{$item->id}}" class="btn btn-success">Edit</a> 
                    @if ($item->status == 0)
                    <a href="/status_update_coupon/1/{{$item->id}}" class="btn btn-primary">Active</a> 
                    @elseif($item->status == 1)
                    <a href="/status_update_coupon/0/{{$item->id}}" class="btn btn-warning">Deactive</a>
                    @endif
                    <a href="/coupon_delete/{{$item->id}}" class="btn btn-danger">Delete</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE-->
</div>
@stop