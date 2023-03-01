@extends('admin_login.index')
@section('tittle', 'Color Update')
@section('color_selected', 'active')
@section('content')
<h1>Color Manage</h1>
<h3 class="mt-3"><a href="{{ url('color')}}" class="btn btn-primary"><- Back</a></h3>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{url('/color_updatedata')}}/{{$data->id}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="color" class="control-label mb-1">color</label>
                    <input id="color" name="color" type="text" value="{{$data->color}}" class="form-control" >
                    @error('color')
                         <p class="text-danger">{{$message}}</p>
                     @enderror
                </div>
                <div>
                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                       Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop