@extends('admin_login.index')
@section('tittle', 'Brand')
@section('brand_selected', 'active')
@section('content')
<h1>Brand Manage</h1>
<h3 class="mt-3"><a href="{{url('brand_add')}}" class="btn btn-primary">+ Add Brand</a></h3>
<div class="col-md-12 mt-5">
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3 ">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Brand Name</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->brand}}</td>
                    <td>{{$item->brand_image}}</td>
                    <td><a href="{{url('brand_update')}}/{{$item->id}}" class="btn btn-success">Edit</a> 
                    @if ($item->status == 0)
                    <a href="{{url('status_update_brand/1')}}/{{$item->id}}" class="btn btn-primary">Active</a> 
                    @elseif($item->status == 1)
                    <a href="{{url('status_update_brand/0')}}/{{$item->id}}" class="btn btn-warning">Deactive</a>
                    @endif
                    <a href="{{url('brand_delete')}}/{{$item->id}}" class="btn btn-danger">Delete</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE-->
</div>
@stop