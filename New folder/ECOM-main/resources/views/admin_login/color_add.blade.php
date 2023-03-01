@extends('admin_login.index')
@section('tittle', 'Color Add')
@section('color_selected', 'active')
@section('content')
<h1>Color Manage</h1>
<h3 class="mt-3"><a href="{{ url('color')}}" class="btn btn-primary"><- Back</a></h3>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{route('color_insert')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="color" class="control-label mb-1">Color</label>
                    <input id="color" name="color" type="text" value="{{old('color')}}" class="form-control" placeholder="color ">
                    @error('color')
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