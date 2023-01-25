@extends('admin_login.index')
@section('tittle', 'color')
@section('color_selected', 'active')
@section('content')
<h1>COLOR</h1>
<h3 class="mt-3"><a href="color_add" class="btn btn-primary">+ Add Color</a></h3>
<div class="col-md-12 mt-5">
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>color</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->color}}</td>
                    <td><a href="/color_update/{{$item->id}}" class="btn btn-success">Edit</a> 
                    @if ($item->status == 0)
                    <a href="/status_update_color/1/{{$item->id}}" class="btn btn-primary">Active</a> 
                    @elseif($item->status == 1)
                    <a href="/status_update_color/0/{{$item->id}}" class="btn btn-warning">Deactive</a>
                    @endif
                    <a href="/color_delete/{{$item->id}}" class="btn btn-danger">Delete</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE-->
</div>
@stop