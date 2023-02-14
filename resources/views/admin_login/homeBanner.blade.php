@extends('admin_login.index')
@section('tittle', 'homeBanner')
@section('homeBanner_selected', 'active')
@section('content')
<h1>Category Manage</h1>
<h3 class="mt-3"><a href="{{url('homeBanner_add')}}" class="btn btn-primary">+ Add homeBanner</a></h3>
<div class="col-md-12 mt-5">
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3 ">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Text btn</th>
                    <th>Link btn</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->btn_txt}}</td>
                    <td>{{$item->btn_link}}</td>
                    <td><a href="{{asset('storage/media/'.$item->image)}}" target="_blank"><img src="{{asset('storage/media/'.$item->image)}}" width="100px" height="100px" style="border-radius: 50%" alt="ddd"></a> </td>
                    <td><a href="{{url('homeBanner_update')}}/{{$item->id}}" class="btn btn-success">Edit</a> 
                    @if ($item->status == 0)
                    <a href="{{url('status_update_homeBanner/1')}}/{{$item->id}}" class="btn btn-primary">Active</a> 
                    @elseif($item->status == 1)
                    <a href="{{url('status_update_homeBanner/0')}}/{{$item->id}}" class="btn btn-warning">Deactive</a>
                    @endif
                    <a href="{{url('homeBanner_delete')}}/{{$item->id}}" class="btn btn-danger">Delete</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE-->
</div>
@stop