@extends('admin_login.index')
@section('tittle', 'Categories Update')
@section('category_selected', 'active')
@section('content')
<h1>Category Manage</h1>
<h3 class="mt-3"><a href="{{ url('category')}}" class="btn btn-primary"><- Back</a></h3>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{url('/category_updatedata')}}/{{$data->id}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="category_name" class="control-label mb-1">Category Name</label>
                            <input id="category_name" name="category_name" type="text" value="{{$data->category_name}}" class="form-control" placeholder="Category Name">
                            @error('category_name')
                                 <p class="text-danger">{{$message}}</p>
                             @enderror
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="parent_category" class="control-label mb-1">Parant Category</label>
                            <select class="form-select form-control" name="parent_category" aria-label="Default select example" required>
                                <option value="">Select </option>
                                @foreach ($category as $item)
                                @if ($data->parent_category == $item->id)
                                 <option selected value="{{$item->id}}">  
                                 @else
                                 <option value="{{$item->id}}"> 
                                 @endif
                                 {{$item->category_name}}</option> 
                                @endforeach
                              </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="category_slug" class="control-label mb-1">Category Slug</label>
                            <input id="category_slug" name="category_slug" type="text" value="{{$data->category_slug}}"  class="form-control" placeholder="Category Slug">
                             @error('category_slug')
                                 <p class="text-danger">{{$message}}</p>
                             @enderror
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="category_image" class="control-label mb-1">Category Image</label>
                            <input id="category_image" name="category_image" type="file" value="{{old('category_image')}}"  class="form-control">
                           <a href="{{asset('storage/media/')}}/{{$data->category_image}}" target="_blank"><img src="{{asset('storage/media/')}}/{{$data->category_image}}" width="100px" height="150px" alt=""></a> 
                            @error('category_image')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                   
                </div>
                <div class="form-group has-success">
                    
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