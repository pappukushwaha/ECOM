@extends('admin_login.index')
@section('tittle', 'Categories Add')
@section('category_selected', 'active')
@section('content')
<h1>Category Manage</h1>
<h3 class="mt-3"><a href="{{ url('category')}}" class="btn btn-primary"><- Back</a></h3>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{route('category_insert')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="category_name" class="control-label mb-1">Category Name</label>
                            <input id="category_name" name="category_name" type="text" value="{{old('category_name')}}" class="form-control" placeholder="Category Name">
                            @error('category_name')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="parent_category" class="control-label mb-1">Parent Category</label>
                            <select class="form-select form-control" name="parent_category" aria-label="Default select example" >
                                <option value="">Select </option>
                                @foreach ($data as $item)
                                <option value="{{$item->id}}">{{$item->category_name}}</option>
                                @endforeach
                              </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="category_slug" class="control-label mb-1">Category Slug</label>
                            <input id="category_slug" name="category_slug" type="text" value="{{old('category_slug')}}"  class="form-control" placeholder="Category Slug">
                            @error('category_slug')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="category_image" class="control-label mb-1">Category Image</label>
                            <input id="category_image" name="category_image" type="file" value="{{old('category_image')}}"  class="form-control">
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