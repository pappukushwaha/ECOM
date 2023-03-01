@extends('admin_login.index')
@section('tittle', 'Tax Add')
@section('tax_selected', 'active')
@section('content')
<h1>Tax Manage</h1>
<h3 class="mt-3"><a href="{{ url('tax')}}" class="btn btn-primary"><- Back</a></h3>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{route('tax_insert')}}" method="post">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="tax_desc" class="control-label mb-1">Tax Desc</label>
                            <input id="tax_desc" name="tax_desc" type="text" value="{{old('tax_desc')}}" class="form-control" placeholder="Tax Desc ">
                            @error('tax_desc')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="tax_value" class="control-label mb-1">Tax Value</label>
                            <input id="tax_value" name="tax_value" type="text" value="{{old('tax_value')}}" class="form-control" placeholder="Tax Value ">
                            @error('tax_value')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
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