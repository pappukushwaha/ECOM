@extends('admin_login.index')
@section('tittle', 'Category')
@section('size_selected', 'active')
@section('content')
<h1>SIZE</h1>
<h3 class="mt-3"><a href="size_add" class="btn btn-primary">+ Add size</a></h3>
<div class="col-md-12 mt-5">
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Size</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->size}}</td>
                    <td><a href="/size_update/{{$item->id}}" class="btn btn-success">Edit</a> 
                    @if ($item->status == 0)
                    <a href="/status_update_size/1/{{$item->id}}" class="btn btn-primary">Active</a> 
                    @elseif($item->status == 1)
                    <a href="/status_update_size/0/{{$item->id}}" class="btn btn-warning">Deactive</a>
                    @endif
                    <a href="/size_delete/{{$item->id}}" class="btn btn-danger">Delete</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE-->
</div>
@stop