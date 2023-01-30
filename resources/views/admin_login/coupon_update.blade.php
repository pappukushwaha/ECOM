@extends('admin_login.index')
@section('tittle', 'Coupon Update')
@section('coupon_selected', 'active')
@section('content')
<h1>Category Manage</h1>
<h3 class="mt-3"><a href="category" class="btn btn-primary"><- Back</a></h3>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{url('/coupon_updatedata')}}/{{$data->id}}" method="post">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                             <label for="coupon_tittle" class="control-label mb-1">Coupon Tittle</label>
                            <input id="coupon_tittle" name="coupon_tittle" type="text" value="{{$data->coupon_tittle}}" class="form-control" >
                            @error('coupon_tittle')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="coupon_code" class="control-label mb-1">Coupon Code</label>
                            <input id="coupon_code" name="coupon_code" type="text" value="{{$data->coupon_code}}"  class="form-control" >
                             @error('coupon_code')
                                 <p class="text-danger">{{$message}}</p>
                             @enderror
                        </div>
                        <div class="col-md-6 mt-3">
                             <label for="coupon_value" class="control-label mb-1">Coupon Value</label>
                            <input id="coupon_value" name="coupon_value" type="text" value="{{$data->coupon_value}}"  class="form-control" >
                            @error('coupon_value')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="type" class="control-label mb-1">Type</label>
                            <select class="form-select form-control" name="type" aria-label="Default select example" required>
                                @if ($data->type == 'Value')
                                <option selected value="Value">Value</option>
                                <option  value="Per">Per</option>
                                @elseif($data->type == 'Per')
                                <option  value="Value">Value</option>
                                <option selected value="Per">Per</option>
                                @else
                                <option  value="Value">Value</option>
                                <option  value="Per">Per</option>
                                @endif
                               
                            </select>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="min_order_amount" class="control-label mb-1">Min Order Amount</label>
                            <input id="min_order_amount" name="min_order_amount" type="text" value="{{$data->min_order_amount}}"  class="form-control" placeholder="Min Order Amount">
                            @error('min_order_amount')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="is_one_time" class="control-label mb-1">Is One Time</label>
                            <select class="form-select form-control" name="is_one_time" aria-label="Default select example" required>
                                @if ($data->is_one_time == 1)
                                <option selected value="1">Yes</option>
                                <option  value="0">No</option>
                                @else
                                <option  value="1">Yes</option>
                                <option selected value="0">No</option>
                                @endif
                               
                            </select>
                        </div>
                    </div>
                   
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