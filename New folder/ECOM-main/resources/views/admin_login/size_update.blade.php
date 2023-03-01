@extends('admin_login.index')
@section('tittle', 'Categories Update')
@section('category_selected', 'active')
@section('content')
<h1>Category Manage</h1>
<h3 class="mt-3"><a href="{{ url('category')}}" class="btn btn-primary"><- Back</a></h3>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{url('/size_updatedata')}}/{{$data->id}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="size" class="control-label mb-1">Size</label>
                    <input id="size" name="size" type="text" value="{{$data->size}}" class="form-control" >
                    @error('size')
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