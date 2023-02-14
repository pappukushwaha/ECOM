@extends('admin_login.index')
@section('tittle', 'Home Banner Add')
@section('homeBanner_selected', 'active')
@section('content')
<h1>Category Manage</h1>
<h3 class="mt-3"><a href="{{ url('homeBanner')}}" class="btn btn-primary"><- Back</a></h3>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{route('homeBanner_insert')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="btn_txt" class="control-label mb-1">Button Name</label>
                            <input id="btn_txt" name="btn_txt" type="text" value="{{old('btn_txt')}}" class="form-control" placeholder="Button Name">
                            @error('btn_txt')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                       
                        <div class="col-md-4 mt-3">
                            <label for="btn_link" class="control-label mb-1">Text Link</label>
                            <input id="category_slug" name="btn_link" type="text" value="{{old('btn_link')}}"  class="form-control" placeholder="Text Link">
                            @error('btn_link')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="homeBanner_image" class="control-label mb-1">Home Banner Image</label>
                            <input id="homeBanner_image" name="homeBanner_image" type="file" value="{{old('homeBanner_image')}}"  class="form-control">
                            @error('homeBanner_image')
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