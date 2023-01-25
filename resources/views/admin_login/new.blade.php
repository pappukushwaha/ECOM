@extends('admin_login.index')
@section('tittle', 'Categories Update')
@section('category_selected', 'active')
@section('content')
<h1>Category Manage</h1>
<h3 class="mt-3"><a href="{{ url('category')}}" class="btn btn-primary"><- Back</a></h3>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{url('/category_updatedata')}}/{{$data->id}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="category_name" class="control-label mb-1">Category Name</label>
                    <input id="category_name" name="category_name" type="text" value="{{$data->category_name}}" class="form-control" placeholder="Category Name">
                    @error('category_name')
                         <p class="text-danger">{{$message}}</p>
                     @enderror
                </div>
                <div class="form-group has-success">
                    <label for="category_slug" class="control-label mb-1">Category Slug</label>
                    <input id="category_slug" name="category_slug" type="text" value="{{$data->category_slug}}"  class="form-control" placeholder="Category Slug">
                     @error('category_slug')
                         <p class="text-danger">{{$message}}</p>
                     @enderror
                </div>
                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                       Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop