@extends('admin_login.index')
@section('tittle', 'Coupon Add')
@section('coupon_selected', 'active')
@section('content')
<h1>Category Manage</h1>
<h3 class="mt-3"><a href="coupon" class="btn btn-primary"><- Back</a></h3>

<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{route('coupon_insert')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="coupon_tittle" class="control-label mb-1">Coupon Tittle</label>
                    <input id="coupon_tittle" name="coupon_tittle" type="text" value="{{old('coupon_tittle')}}" class="form-control" placeholder="Coupon Tittle">
                    @error('coupon_tittle')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="coupon_code" class="control-label mb-1">Coupon Code</label>
                    <input id="coupon_code" name="coupon_code" type="text" value="{{old('coupon_code')}}"  class="form-control" placeholder="Coupon Code">
                    @error('coupon_code')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="coupon_value" class="control-label mb-1">Coupon Value</label>
                    <input id="coupon_value" name="coupon_value" type="text" value="{{old('coupon_value')}}"  class="form-control" placeholder="Coupon Value">
                    @error('coupon_value')
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