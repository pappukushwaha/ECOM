@extends('admin_login.index')
@section('tittle', 'Brand Add')
@section('brand_selected', 'active')
@section('content')
<h1>Brand Manage</h1>
<h3 class="mt-3"><a href="{{ url('brand')}}" class="btn btn-primary"><- Back</a></h3>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{route('brand_insert')}}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="form-group">
                    <label for="brand" class="control-label mb-1">Brand Name</label>
                    <input id="brand" name="brand" type="text" value="{{old('brand')}}" class="form-control" placeholder="Brand Name">
                    @error('brand')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group has-success">
                    <label for="brand_img" class="control-label mb-1">Brand Image</label>
                    <input id="brand_img" name="brand_img" type="file" value="{{old('brand_img')}}"  class="form-control" placeholder="Brand Image">
                    @error('brand_img')
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