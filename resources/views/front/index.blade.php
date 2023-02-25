@extends('front.layout')
@section('tittle')
Product Section
@endsection
@section('container')
  <!-- Start slider -->
  <section id="aa-slider">
    <div class="aa-slider-area">
      <div id="sequence" class="seq">
        <div class="seq-screen">
          <ul class="seq-canvas">

            <!-- single slide item -->
            @foreach ($home_banners as $item)
            <li>
              <div class="seq-model">
                <img data-seq src="{{asset('storage/media')}}/{{$item->image}}" alt="Men slide img" />
              </div>
              @if ($item->btn_txt != '')
                <div class="seq-title">
                <a data-seq href="{{$item->btn_link}}" target="_blank" class="aa-shop-now-btn aa-secondary-btn">{{$item->btn_txt}}</a>
              </div>
              @endif
             
            </li>
            @endforeach
            <!-- single slide item -->

                       
          </ul>
        </div>
        <!-- slider navigation btn -->
        <fieldset class="seq-nav" aria-controls="sequence" aria-label="Slider buttons">
          <a type="button" class="seq-prev" aria-label="Previous"><span class="fa fa-angle-left"></span></a>
          <a type="button" class="seq-next" aria-label="Next"><span class="fa fa-angle-right"></span></a>
        </fieldset>
      </div>
    </div>
  </section>
  <!-- / slider -->
  <!-- Start Promo section -->
  <section id="aa-promo">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-area">
            <div class="row">
              <!-- promo left -->
             
              <!-- promo right -->
              <div class="col-md-12 no-padding">
                <div class="aa-promo-right">
                @foreach ($home_categories as $item)
                  <div class="aa-single-promo-right">
                    <div class="aa-promo-banner col-md-4">                      
                      <img src="{{asset('storage/media')}}/{{$item->category_image}}" class="img-fluid" alt="img">                      
                      <div class="aa-prom-content">
                        <h4><a href="{{url('category/'.$item->category_slug)}}">{{$item->category_name}}</a></h4>                        
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo section -->
  <!-- Products section -->
  <section id="aa-product">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-product-area">
              <div class="aa-product-inner">
                <!-- start prduct navigation -->
                 <ul class="nav nav-tabs aa-products-tab">
                  @foreach ($home_categories as $item)
                    <li class=""><a href="#cat{{$item->id}}" data-toggle="tab">{{$item->category_name}}</a></li>
                    @endforeach
                  </ul>
                  <!-- Tab panes -->
                  <div class="tab-content">
                    <!-- Start men product category -->
                    @php
                    $loop_count = 1;    
                    @endphp
                    @foreach ($home_categories as $item)
                    @php
                       $class_active='';
                        if($loop_count==1){
                           $class_active='in active';
                           $loop_count++;
                        }
                    @endphp
                    <div class="tab-pane fade {{$class_active}}" id="cat{{$item->id}}">
                      <ul class="aa-product-catg">
                        <!-- start single product item -->
                        @if (isset($home_categories_product[$item->id][0]))
                        @foreach ($home_categories_product[$item->id] as $product)
                          <li>
                            <figure>
                              <a class="aa-product-img" href="{{url('/product/'.$product->slug)}}"><img src="{{asset('storage/media')}}/{{$product->image}}" width="250px" height="300px" alt="polo shirt img"></a>
                              <a class="aa-add-card-btn"href="{{url('/product/'.$product->slug)}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                <figcaption>
                                <h4 class="aa-product-title"><a href="{{url('/product/'.$product->slug)}}">{{$product->name}}</a></h4>
                                <span class="aa-product-price">Rs {{$home_product_attr[$product->id][0]->price}}</span><span class="aa-product-price"><del>Rs {{$home_product_attr[$product->id][0]->mrp}}</del></span>
                              </figcaption>
                            </figure>                        
                          </li>
                        @endforeach
                        @else
                        <li>
                          <figure>
                            No Data Found
                          </figure>
                        </li>
                        @endif

                      </ul>
                    </div>
                    @endforeach
                    <!-- / men product category -->
                  </div>
                               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Products section -->
  <!-- banner section -->
  <section id="aa-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">        
          <div class="row">
            <div class="aa-banner-area">
            <a href="#"><img src="{{asset('front_assets/img/fashion-banner.jpg')}}" alt="fashion banner img"></a>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- popular section -->
  <section id="aa-popular-category">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="aa-popular-category-area">
              <!-- start prduct navigation -->
             <ul class="nav nav-tabs aa-products-tab">
                <li class="active"><a href="#featured" data-toggle="tab">Featured</a></li>
                <li><a href="#tranding" data-toggle="tab">Tranding</a></li>
                <li><a href="#discount" data-toggle="tab">Discount</a></li>                    
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                <!-- Start men popular category -->
                <div class="tab-pane fade in active" id="featured">
                  <ul class="aa-product-catg aa-popular-slider">
                    <!-- start single product item -->
                    @if (isset($home_featured_product[$item->id][0]))
                    @foreach ($home_featured_product[$item->id] as $product)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="{{url('/product/'.$product->slug)}}"><img src="{{asset('storage/media')}}/{{$product->image}}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="{{url('/product/'.$product->slug)}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption>
                          <h4 class="aa-product-title"><a href="{{url('/product/'.$product->slug)}}">{{$product->name}}</a></h4>
                          <span class="aa-product-price">Rs {{$home_featured_product_attr[$product->id][0]->price}}</span><span class="aa-product-price"><del>Rs {{$home_featured_product_attr[$product->id][0]->mrp}}</del></span>
                        </figcaption>
                      </figure>                     
                    </li>
                    @endforeach
                        @else
                        <li>
                          <figure>
                            No Data Found
                          </figure>
                        </li>
                        @endif
                     <!-- start single product item -->
                                                                                                
                  </ul>
                  <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / popular product category -->
                
                <!-- start featured product category -->
                <div class="tab-pane fade" id="tranding">
                 <ul class="aa-product-catg aa-featured-slider">
                    <!-- start single product item -->
                    @if (isset($home_trending_product[$item->id][0]))
                    @foreach ($home_trending_product[$item->id] as $product)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="{{url('/product/'.$product->slug)}}"><img src="{{asset('storage/media')}}/{{$product->image}}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="{{url('/product/'.$product->slug)}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption>
                          <h4 class="aa-product-title"><a href="{{url('/product/'.$product->slug)}}">{{$product->name}}</a></h4>
                          <span class="aa-product-price">Rs {{$home_trending_product_attr[$product->id][0]->price}}</span><span class="aa-product-price"><del>Rs {{$home_trending_product_attr[$product->id][0]->mrp}}</del></span>
                        </figcaption>
                      </figure>                     
                    </li>
                    @endforeach
                        @else
                        <li>
                          <figure>
                            No Data Found
                          </figure>
                        </li>
                        @endif
                     <!-- start single product item -->
                                                                                              
                  </ul>
                  <a class="aa-browse-btn" href="#">Browse all Product <span class="fa fa-long-arrow-right"></span></a>
                </div>
                <!-- / featured product category -->

                <!-- start latest product category -->
                <div class="tab-pane fade" id="discount">
                  <ul class="aa-product-catg aa-latest-slider">
                    <!-- start single product item -->
                    @if (isset($home_descounted_product[$item->id][0]))
                    @foreach ($home_descounted_product[$item->id] as $product)
                    <li>
                      <figure>
                        <a class="aa-product-img" href="{{url('/product/'.$product->slug)}}"><img src="{{asset('storage/media')}}/{{$product->image}}" alt="polo shirt img"></a>
                        <a class="aa-add-card-btn"href="{{url('/product/'.$product->slug)}}"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                         <figcaption>
                          <h4 class="aa-product-title"><a href="{{url('/product/'.$product->slug)}}">{{$product->name}}</a></h4>
                          <span class="aa-product-price">Rs {{$home_descounted_product_attr[$product->id][0]->price}}</span><span class="aa-product-price"><del>Rs {{$home_descounted_product_attr[$product->id][0]->mrp}}</del></span>
                        </figcaption>
                      </figure>                     
                    </li>
                    @endforeach
                        @else
                        <li>
                          <figure>
                            No Data Found
                          </figure>
                        </li>
                        @endif
                     <!-- start single product item -->
                    
                    <!-- start single product item -->
                                                                                           
                  </ul>
                </div>
                <!-- / latest product category -->              
              </div>
            </div>
          </div> 
        </div>
      </div>
    </div>
  </section>
  <!-- / popular section -->
 
  
  

  <!-- Client Brand -->
  <section id="aa-client-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-client-brand-area">
            <ul class="aa-client-brand-slider">
              @foreach ($home_brand as $brand)
              <li style="height: 80px;"><a href="#"><img src="{{asset('storage/media')}}/{{$brand->brand_img}}" alt="{{$brand->brand}}"></a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Client Brand -->

@endsection