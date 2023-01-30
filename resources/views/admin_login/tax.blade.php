@extends('admin_login.index')
@section('tittle', 'tax')
@section('tax_selected', 'active')
@section('content')
<h1>Tax</h1>
<h3 class="mt-3"><a href="tax_add" class="btn btn-primary">+ Add Tax</a></h3>
<div class="col-md-12 mt-5">
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tax Desc</th>
                    <th>Tax Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->tax_desc}}</td>
                    <td>{{$item->tax_value}}</td>
                    <td><a href="/tax_update/{{$item->id}}" class="btn btn-success">Edit</a> 
                    @if ($item->status == 0)
                    <a href="/status_update_tax/1/{{$item->id}}" class="btn btn-primary">Active</a> 
                    @elseif($item->status == 1)
                    <a href="/status_update_tax/0/{{$item->id}}" class="btn btn-warning">Deactive</a>
                    @endif
                    <a href="/tax_delete/{{$item->id}}" class="btn btn-danger">Delete</a> </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- END DATA TABLE-->
</div>
@stop