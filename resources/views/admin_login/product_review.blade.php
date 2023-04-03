@extends('admin_login.index')
@section('tittle', 'Product Review')
@section('product_review_selected', 'active')
@section('content')
<h1>Product Review</h1>
<div class="col-md-12 mt-5">
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>User</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Added On</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->pname}}</td>
                    <td>{{$item->rating}}</td>
                    <td>{{$item->review}}</td>
                    <td>{{$item->added_on}}</td>
                    <td>
                    @if ($item->status == 0)
                    <a href="/product_review_update/1/{{$item->id}}" class="btn btn-primary">Active</a> 
                    @elseif($item->status == 1)
                    <a href="/product_review_update/0/{{$item->id}}" class="btn btn-warning">Deactive</a>
                    @endif
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE-->
</div>
@stop