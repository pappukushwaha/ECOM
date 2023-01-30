@extends('admin_login.index')
@section('tittle', 'Product Update')
@section('product_selected', 'active')
@section('content')
<h1>Category Manage</h1>
<h3 class="mt-3"><a href="{{url('product')}}" class="btn btn-primary"><- Back</a></h3>
<form action="{{url('/product_updatedata')}}/{{$data->id}}" method="post" enctype="multipart/form-data">
<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="name" class="control-label mb-1">Name</label>
                    <input id="name" name="name" type="text" value="{{$data->name}}" class="form-control" placeholder="name">
                    @error('name')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="slug" class="control-label mb-1">Slug</label>
                    <input id="slug" name="slug" type="text" value="{{$data->slug}}"  class="form-control" placeholder="Slug">
                    @error('slug')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="image" class="control-label mb-1">image</label>
                    <input id="image" name="image" type="file" value="{{$data->image}}"  class="form-control" >
                    <a href="{{asset('storage/media/')}}/{{$data->image}}" target="_blank" ><img src="{{asset('storage/media/')}}/{{$data->image}}" width="100px" height="150px" alt=""></a> 
                    @error('image')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="category" class="control-label mb-1">Category</label>
                    {{-- <input id="category" name="category" type="text" value="{{$data->category_id}}"  class="form-control" placeholder="Category"> --}}
                    <select class="form-select form-control" id="category" name="category" aria-label="Default select example">
                        <option value="">Select Categories Id</option>
                        @foreach ($category as $item)
                        @if ($data->category_id == $item->id)
                        <option selected value="{{$item->id}}">  
                        @else
                        <option value="{{$item->id}}"> 
                        @endif
                        {{$item->category_name}}</option> 
                        @endforeach
                      </select>
                    @error('category')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="brand" class="control-label mb-1">Brand</label>
                    {{-- <input id="brand" name="brand" type="text" value="{{$data->brand}}"  class="form-control" placeholder="Brand"> --}}
                    <select class="form-select form-control" id="brand" name="brand" aria-label="Default select example">
                        <option value="">Select Brand</option>
                        @foreach ($brand as $item)
                        @if ($data->brand == $item->id)
                        <option selected value="{{$item->id}}">  
                        @else
                        <option value="{{$item->id}}"> 
                        @endif
                        {{$item->brand}}</option> 
                        @endforeach
                      </select>
                    @error('brand')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="model" class="control-label mb-1">Model</label>
                    <input id="model" name="model" type="text" value="{{$data->model}}"  class="form-control" placeholder="Model">
                    @error('model')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="short_desc" class="control-label mb-1">short_desc</label>
                    <textarea id="short_desc" name="short_desc" type="text"  class="form-control" placeholder="short_desc">{{$data->short_desc}}</textarea>
                    @error('short_desc')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="desc" class="control-label mb-1">desc</label>
                    <textarea id="desc" name="desc" type="text"  class="form-control" placeholder="desc">{{$data->desc}}</textarea>
                    @error('desc')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="keywords" class="control-label mb-1">keywords</label>
                    <textarea id="keywords" name="keywords" type="text" value=""  class="form-control" placeholder="keywords">{{$data->keywords}}</textarea>
                    @error('keywords')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="technical_specification" class="control-label mb-1">technical_specification</label>
                    <textarea id="technical_specification" name="technical_specification" type="text" value=""  class="form-control" placeholder="technical_specification">{{$data->technical_specification}}</textarea>
                    @error('technical_specification')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="uses" class="control-label mb-1">uses</label>
                    <textarea id="uses" name="uses" type="text" value=""  class="form-control" placeholder="uses">{{$data->uses}}</textarea>
                    @error('uses')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <label for="warranty" class="control-label mb-1">warranty</label>
                    <textarea id="warranty" name="warranty" type="text" value=""  class="form-control" placeholder="warranty">{{$data->warranty}}</textarea>
                    @error('warranty')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <label for="leed_time" class="control-label mb-1">Leed Time</label>
                            <input id="leed_time" name="leed_time" type="text" value="{{$data->leed_time}}"  class="form-control" placeholder="Leed Time" >
                            @error('leed_time')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="tax_desc" class="control-label mb-1">Tax</label>
                            <select class="form-select form-control" id="tax_desc" name="tax_desc" aria-label="Default select example">
                                <option value="">Select</option>
                                @foreach ($tax as $item)
                                @if ($data->tax_id == $item->id)
                                <option selected value="{{$item->id}}">  
                                @else
                                <option value="{{$item->id}}"> 
                                @endif
                                {{$item->tax_desc}}</option> 
                                @endforeach
                              </select>
                            @error('brand')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                        </div>
                      
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <label for="is_promo" class="control-label mb-1">Is Promo</label>
                            <select class="form-select form-control" name="is_promo" aria-label="Default select example" required>
                                @if ($data->is_promo == 1)
                                <option selected value="1">Yes</option>
                                <option  value="0">No</option>
                                @else
                                <option  value="1">Yes</option>
                                <option selected value="0">No</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-3 mt-2">
                            <label for="is_featured" class="control-label mb-1">Is Featured</label>
                            <select class="form-select form-control" name="is_featured" aria-label="Default select example" required>
                                @if ($data->is_featured == 1)
                                <option selected value="1">Yes</option>
                                <option  value="0">No</option>
                                @else
                                <option  value="1">Yes</option>
                                <option selected value="0">No</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-3 mt-2">
                            <label for="is_descounted" class="control-label mb-1">Is Descounted</label>
                            <select class="form-select form-control" name="is_descounted" aria-label="Default select example" required>
                                @if ($data->is_descounted == 1)
                                <option selected value="1">Yes</option>
                                <option  value="0">No</option>
                                @else
                                <option  value="1">Yes</option>
                                <option selected value="0">No</option>
                                @endif
                            </select>
                        </div>

                        <div class="col-md-3 mt-2">
                            <label for="is_trending" class="control-label mb-1">Is Trending</label>
                            <select class="form-select form-control" name="is_trending" aria-label="Default select example" required>
                                @if ($data->is_trending == 1)
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

            </div>
        </div> 
    </div>
   

    <h1>Product Attribute Manage</h1>
<div class="col-lg-12 mt-3" id="product_attr_box">
    @php
    $product_attr_arr = $product_attr;
    $loop_count_num = 1;
    @endphp
    @foreach ($product_attr_arr as $item)
        <div class="card" id="product_attr_{{$loop_count_num++}}">
        <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <input type="hidden" name="paid[]" id="" value="{{$item->id}}">
                        <div class="col-md-2">
                            <label for="sku" class="control-label mb-1">SKU</label>
                            <input id="name" name="sku[]" type="text" value="{{$item->sku}}" class="form-control" placeholder="SKU">
                            @error('sku')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="mrp" class="control-label mb-1">MRP</label>
                            <input id="mrp" name="mrp[]" type="text" value="{{$item->mrp}}" class="form-control" placeholder="MRP">
                            @error('mrp')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="price" class="control-label mb-1">Price</label>
                            <input id="price" name="price[]" type="text" value="{{$item->price}}" class="form-control" placeholder="PRICE">
                            @error('price')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="size" class="control-label mb-1">Size</label>
                            <select class="form-select form-control" name="size_id[]" id="size_id" aria-label="Default select example">
                                <option value="">Select</option>
                                @foreach ($size as $items)
                                @if ($item->size_id == $items->id)
                                 <option selected value="{{$items->id}}">  
                                 @else
                                 <option value="{{$items->id}}"> 
                                 @endif
                                 {{$items->size}}</option> 
                                @endforeach
                            </select>
                            @error('size')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="color" class="control-label mb-1">Color</label>
                            <select class="form-select form-control" name="color_id[]" id="color_id" aria-label="Default select example">
                                <option value="">Select</option>
                                @foreach ($color as $items)
                                @if ($item->color_id == $items->id)
                                 <option selected value="{{$items->id}}">  
                                 @else
                                 <option value="{{$items->id}}"> 
                                 @endif
                                 {{$items->color}}</option> 
                                @endforeach
                            </select>
                            @error('size')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-2">
                            <label for="qty" class="control-label mb-1">QTY</label>
                            <input id="qty" name="qty[]" type="text" value="{{$item->qty}}" class="form-control" placeholder="QTY">
                            @error('qty')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="att_image" class="control-label mb-1">Attribute Image</label>
                            <input id="att_image" name="att_image[]" type="file" class="form-control" placeholder="Att Image">
                           <a href="{{asset('storage/media/')}}/{{$item->att_image}}" target="_blank"><img src="{{asset('storage/media/')}}/{{$item->att_image}}" width="100px" height="150px" alt=""></a> 
                            @error('att_image')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                          @if ($loop_count_num == 2)
                            <div class="col-md-4 mt-4">
                             <label for="att_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                             <button type="button" class="btn btn-success btn-lg" onclick="add_more()"> + Add</button>
                            </div>
                          @else
                           <div class="col-md-4 mt-4">
                             <label for="att_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                             <a href="{{url('product_attr_delete')}}/{{$item->id}}/{{$data->id}}">
                             <button type="button" class="btn btn-danger btn-lg"> - remove</button></a>
                           </div>
                          @endif
                    </div>
                </div>  
        </div>
    </div>
    @endforeach 
</div>


<h1>Product Image Manage</h1>
<div class="col-lg-12 mt-3" id="product_attr_box">
    <div class="card" id="product_attr_1">
        <div class="card-body">
                <div class="form-group">
                    <div class="row" id="product_image_box">
                        @php
                            $loop_count_num = 1;
                        @endphp
                        @foreach ($product_images as $item)

                        <div class="col-md-4 mb-3 add_more_image_{{$loop_count_num++}}">
                            <input type="hidden" name="piid[]" value="{{$item->id}}">
                            <label for="product_image" class="control-label mb-1">Product Image</label>
                            <input id="product_image" name="product_image[]" type="file" value="{{$item->product_image}}" class="form-control" >
                            <a href="{{asset('storage/media/')}}/{{$item->product_image}}" target="_blank"><img src="{{asset('storage/media/')}}/{{$item->product_image}}" width="100px" height="150px" alt=""></a> 
                            @error('product_image')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        @if ($loop_count_num == 2)
                             <div class="col-md-2 mt-4 add_more_image_1">
                                <label for="att_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" class="btn btn-success btn-lg" onclick="add_more_image()"> + Add</button>
                            </div>
                        @else
                        <div class="col-md-2 mt-4 add_more_image_1">
                            <label for="att_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <a href="{{url('product_image_delete')}}/{{$item->id}}/{{$data->id}}">
                            <button type="button" class="btn btn-danger btn-lg"> - remove</button></a>
                        </div>
                        @endif
                       
                        @endforeach
                    </div>
                </div>   
        </div>
    </div>
</div>




    <div>
        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
           Update
        </button>
    </div>
</form>

<script>
    var loop_count = 1111;
    function add_more(){
        loop_count++;
        
       html = '<input type="hidden" name="paid[]" id=""><div class="card"id="product_attr_'+loop_count+'"><div class="card-body"><div class="form-group"><div class="row">';
        html += ' <div class="col-md-2"><label for="sku" class="control-label mb-1">SKU</label><input id="name" name="sku[]" type="text" class="form-control" placeholder="SKU"></div>';
        html += ' <div class="col-md-2"><label for="mrp" class="control-label mb-1">MRP</label><input id="name" name="mrp[]" type="text"  class="form-control" placeholder="MRP"></div>'
        html += ' <div class="col-md-2"><label for="price" class="control-label mb-1">Price</label><input id="name" name="price[]" type="text"  class="form-control" placeholder="PRICE"></div>'
      var size_id_html = jQuery('#size_id').html();
      size_id_html = size_id_html.replace("selected", "");
        html += '<div class="col-md-3"><label for="size" class="control-label mb-1">Size</label><select class="form-select form-control" name="size_id[]" id="size_id" aria-label="Default select example">'+size_id_html+'</select></div>'

        var color_id_html = jQuery('#color_id').html();
      color_id_html = color_id_html.replace("selected", "");
        
        html += '<div class="col-md-3"><label for="color" class="control-label mb-1">Color</label><select class="form-select form-control" name="color_id[]" id="color_id" aria-label="Default select example">'+color_id_html+'</select></div>'
        

        html += ' <div class="col-md-2"><label for="qty" class="control-label mb-1">QTY</label><input id="name" name="qty[]" type="text"  class="form-control" placeholder="QTY"></div>'
        html += ' <div class="col-md-4"><label for="image" class="control-label mb-1">Attribute Image</label><input id="name" name="att_image[]" type="file"  class="form-control" ></div>'
       html += '<div class="col-md-4 mt-4"><label for="att_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;&nbsp;</label><button type="button" class="btn btn-danger btn-lg" onclick=remove_more("'+loop_count+'")> - Remove</button></div>'
       html +='</div></div></div></div>'; 

        jQuery('#product_attr_box').append(html);
    }
    function remove_more(loop_count){
        jQuery('#product_attr_'+loop_count).remove();
    }

    var loop_count_image = 111111;
    function add_more_image(){
        loop_count_image++;
        html = '<input type="hidden" name="piid[]" value=""><div class="col-md-4  add_more_image_'+loop_count_image+'">\
                            <label for="product_image" class="control-label mb-1">Product Image</label>\
                            <input id="product_image" name="product_image[]" type="file" class="form-control" >\
                        </div>\
                        <div class="col-md-2 mt-4 add_more_image_'+loop_count_image+'">\
                            <label for="att_image" class="control-label mb-1">&nbsp;&nbsp;&nbsp;&nbsp;</label>\
                            <button type="button" class="btn btn-danger btn-lg" onclick="remove_more_image('+loop_count_image+')"> - Remove</button>\
                        </div>'; 
    jQuery('#product_image_box').append(html);
    }

    function remove_more_image(loop_count_image){
        jQuery('.add_more_image_'+loop_count_image).remove();
    }
</script>
@stop