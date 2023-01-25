@extends('admin_login.index')
@section('tittle', 'Product Add')
@section('product_selected', 'active')
@section('content')
<h1>Product Manage</h1>
<h3 class="mt-3"><a href="product" class="btn btn-primary"><- Back</a></h3>
<form action="{{route('product_insert')}}" method="post" enctype="multipart/form-data">
    @csrf
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
           
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
               
        </div>
    </div>
</div>

<h1>Product Attribute Manage</h1>
<div class="col-lg-12 mt-3" id="product_attr_box">
    <div class="card" id="product_attr_1">
        <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="sku" class="control-label mb-1">SKU</label>
                            <input id="name" name="sku[]" type="text" value="{{old('sku')}}" class="form-control" placeholder="sku">
                            @error('sku')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="mrp" class="control-label mb-1">MRP</label>
                            <input id="mrp" name="mrp" type="text" value="{{old('mrp')}}" class="form-control" placeholder="MRP">
                            @error('mrp')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="price" class="control-label mb-1">Name</label>
                            <input id="price" name="price" type="text" value="{{old('price')}}" class="form-control" placeholder="PRICE">
                            @error('price')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="size" class="control-label mb-1">Size</label>
                            <select class="form-select form-control" name="size" aria-label="Default select example">
                                <option value="">Select</option>
                                @foreach ($size as $item)
                                        <option value="{{$item->id}}">{{$item->size}}</option>
                                @endforeach
                            </select>
                            @error('size')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="color" class="control-label mb-1">Color</label>
                            <select class="form-select form-control" name="color" aria-label="Default select example">
                                <option value="">Select</option>
                                @foreach ($color as $item)
                                        <option value="{{$item->id}}">{{$item->color}}</option>
                                @endforeach
                            </select>
                            @error('size')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="qty" class="control-label mb-1">Name</label>
                            <input id="qty" name="qty" type="text" value="{{old('qty')}}" class="form-control" placeholder="qty">
                            @error('qty')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="att_image" class="control-label mb-1">Name</label>
                            <input id="att_image" name="att_image" type="file" value="{{old('att_image')}}" class="form-control" placeholder="Att Image">
                            @error('att_image')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-4 mt-4">
                            <label for="att_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <button type="button" class="btn btn-success btn-lg" onclick="add_more()"> + Add</button>
                        </div>
                        
                    </div>
                </div>
                
               
               
        </div>
    </div>
</div>
<div >
    <button id="payment-button" type="submit" class="btn btn-lg btn-info ">
       Submit
    </button>
</div>
</form>

<script>
    var loop_count = 1;
    function add_more(){
        loop_count++;
       html = '<div class="card"id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';
       html += '<div class="col-md-4 mt-4"><label for="att_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")> + Add</button></div>'
       html +='</div></div></div></div>'; 

        jQuery('#product_attr_box').append(html);
    }
    function remove_more(loop_count){
        jQuery('#product_attr_'+loop_count).remove();
    }
</script>
@stop