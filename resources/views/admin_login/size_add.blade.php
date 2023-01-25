@extends('admin_login.index')
@section('tittle', 'Size Add')
@section('size_selected', 'active')
@section('content')
<h1>Size Manage</h1>
<h3 class="mt-3"><a href="{{ url('size')}}" class="btn btn-primary"><- Back</a></h3>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{route('size_insert')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="size" class="control-label mb-1">Size</label>
                    <input id="size" name="size" type="text" value="{{old('size')}}" class="form-control" placeholder="size ">
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