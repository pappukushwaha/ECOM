@extends('admin_login.index')
@section('tittle', 'Product Add')
@section('product_selected', 'active')
@section('content')
<h1>Product Manage</h1>
<h3 class="mt-3"><a href="product" class="btn btn-primary"><- Back</a></h3>
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
            <form action="{{route('product_insert')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name" class="control-label mb-1">Name</label>
                    <input id="name" name="name" type="text" value="{{old('name')}}" class="form-control" placeholder="name">
                    @error('name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug" class="control-label mb-1">Slug</label>
                    <input id="slug" name="slug" type="text" value="{{old('slug')}}"  class="form-control" placeholder="Slug">
                    @error('slug')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="image" class="control-label mb-1">image</label>
                    <input id="image" name="image" type="file" value="{{old('image')}}"  class="form-control" >
                    @error('image')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="category" class="control-label mb-1">Category</label>
                    <select class="form-select form-control" name="category" aria-label="Default select example">
                        <option value="">Select Categories Id</option>
                        @foreach ($data as $item)
                        <option value="{{$item->id}}">{{$item->id}}</option>
                        @endforeach
                      </select>
                    @error('category')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
               
                <div class="form-group">
                    <label for="brand" class="control-label mb-1">Brand</label>
                    <input id="brand" name="brand" type="text" value="{{old('brand')}}"  class="form-control" placeholder="Brand">
                    @error('brand')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="model" class="control-label mb-1">Model</label>
                    <input id="model" name="model" type="text" value="{{old('model')}}"  class="form-control" placeholder="Model">
                    @error('model')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="short_desc" class="control-label mb-1">short_desc</label>
                    <textarea id="short_desc" name="short_desc" type="text"  class="form-control" placeholder="short_desc">{{old('short_desc')}}</textarea>
                    @error('short_desc')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="desc" class="control-label mb-1">desc</label>
                    <textarea id="desc" name="desc" type="text"  class="form-control" placeholder="desc">{{old('desc')}}</textarea>
                    @error('desc')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="keywords" class="control-label mb-1">keywords</label>
                    <textarea id="keywords" name="keywords" type="text" value=""  class="form-control" placeholder="keywords">{{old('keywords')}}</textarea>
                    @error('keywords')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="technical_specification" class="control-label mb-1">technical_specification</label>
                    <textarea id="technical_specification" name="technical_specification" type="text" value=""  class="form-control" placeholder="technical_specification">{{old('technical_specification')}}</textarea>
                    @error('technical_specification')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="uses" class="control-label mb-1">uses</label>
                    <textarea id="uses" name="uses" type="text" value=""  class="form-control" placeholder="uses">{{old('uses')}}</textarea>
                    @error('uses')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="warranty" class="control-label mb-1">warranty</label>
                    <textarea id="warranty" name="warranty" type="text" value=""  class="form-control" placeholder="warranty">{{old('warranty')}}</textarea>
                    @error('warranty')
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