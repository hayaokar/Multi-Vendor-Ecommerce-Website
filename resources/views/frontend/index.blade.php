@extends('frontend.master_dashboard')
@section('main')

    @section('title')
        Home - Easy Shop Online Store
    @endsection

    @include('frontend.home.home_slider')

    <!--End hero slider-->
    @include('frontend.home.home_features_category')

    <!--End category slider-->
    @include('frontend.home.home_banner')
    <!--End banners-->


    @include('frontend.home.home_new_product')

    <!--Products Tabs-->



    @include('frontend.home.home_features_product')


    <!--End Best Sales-->




    <!-- Fashion Category -->

    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3>{{ $skip_category_0->category_name }} Category </h3>

            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">


                        @foreach($skip_product_0 as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ asset( $product->product_thambnail ) }}" alt="" />

                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" id="{{$product->id}}" onclick="addToWishlist(this.id)" class="action-btn"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn" id="{{$product->id}}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                        </div>

                                        @php
                                            $amount = $product->selling_price - $product->discount_price;
                                            $discount = ($amount/$product->selling_price) * 100;

                                        @endphp


                                        <div class="product-badges product-badges-position product-badges-mrg">

                                            @if($product->discount_price == NULL)
                                                <span class="new">New</span>
                                            @else
                                                <span class="hot"> {{ round($discount) }} %</span>
                                            @endif


                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $product->product_name }} </a></h2>
                                        <div class="product-rate-cover">

                                            @php
                                            $reviews = \App\Models\Review::where('product_id',$product->id)->get();
                                            @endphp
                                            @if(count($reviews)!=0)
                                                @php
                                                    $avg =$reviews->avg('rating');
                                                @endphp
                                            <span class="font-small ml-5 text-muted">
                                            @for($i=1; $i<=$avg;$i++)
                                                    <span style="color: gold">★</span>
                                                @endfor
                                                @for($i=1; $i<=(5-$avg);$i++)
                                                    <span >★</span>
                                                @endfor</span>
                                            @else
                                                <span class="font-small ml-5 text-muted">
                                                    No Reviews
                                                </span>
                                            @endif
                                        </div>
                                        <div>
                                            @if($product->vendor_id == NULL)
                                                <span class="font-small text-muted">By Owner</span>
                                            @else
                                                <span class="font-small text-muted">By <a href="{{route('vendor.details', $product['vendor']['id'])}}">{{ $product['vendor']['name'] }}</a></span>

                                            @endif



                                        </div>
                                        <div class="product-card-bottom">

                                            @if($product->discount_price == NULL)
                                                <div class="product-price">
                                                    <span>${{ $product->selling_price }}</span>

                                                </div>

                                            @else
                                                <div class="product-price">
                                                    <span>${{ $product->discount_price }}</span>
                                                    <span class="old-price">${{ $product->selling_price }}</span>
                                                </div>
                                            @endif



{{--                                            <div class="add-cart">--}}
{{--                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end product card-->
                        @endforeach





                    </div>
                    <!--End product-grid-4-->
                </div>


            </div>
            <!--End tab-content-->
        </div>


    </section>
    <!--End Fashion Category -->





    <!-- SweetHome Category -->

    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3>{{ $skip_category_2->category_name }} Category </h3>

            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">


                        @foreach($skip_product_2 as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ asset( $product->product_thambnail ) }}" alt="" />

                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" id="{{$product->id}}" onclick="addToWishlist(this.id)" class="action-btn"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn" id="{{$product->id}}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                        </div>

                                        @php
                                            $amount = $product->selling_price - $product->discount_price;
                                            $discount = ($amount/$product->selling_price) * 100;

                                        @endphp


                                        <div class="product-badges product-badges-position product-badges-mrg">

                                            @if($product->discount_price == NULL)
                                                <span class="new">New</span>
                                            @else
                                                <span class="hot"> {{ round($discount) }} %</span>
                                            @endif


                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $product->product_name }} </a></h2>
                                        <div class="product-rate-cover">
                                            @php
                                                $reviews = \App\Models\Review::where('product_id',$product->id)->get();
                                            @endphp
                                            @if(count($reviews)!=0)
                                                @php
                                                    $avg =$reviews->avg('rating');
                                                @endphp
                                                <span class="font-small ml-5 text-muted">
                                            @for($i=1; $i<=$avg;$i++)
                                                        <span style="color: gold">★</span>
                                                    @endfor
                                                    @for($i=1; $i<=(5-$avg);$i++)
                                                        <span >★</span>
                                                    @endfor</span>
                                            @else
                                                <span class="font-small ml-5 text-muted">
                                                    No Reviews
                                                </span>
                                            @endif
                                        </div>
                                        <div>
                                            @if($product->vendor_id == NULL)
                                                <span class="font-small text-muted">By Owner</span>
                                            @else
                                                <span class="font-small text-muted">By <a href="{{route('vendor.details',$product['vendor']['id'])}}">{{ $product['vendor']['name'] }}</a></span>

                                            @endif



                                        </div>
                                        <div class="product-card-bottom">

                                            @if($product->discount_price == NULL)
                                                <div class="product-price">
                                                    <span>${{ $product->selling_price }}</span>

                                                </div>

                                            @else
                                                <div class="product-price">
                                                    <span>${{ $product->discount_price }}</span>
                                                    <span class="old-price">${{ $product->selling_price }}</span>
                                                </div>
                                            @endif



{{--                                            <div class="add-cart">--}}
{{--                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end product card-->
                        @endforeach





                    </div>
                    <!--End product-grid-4-->
                </div>


            </div>
            <!--End tab-content-->
        </div>


    </section>
    <!--End SweetHome Category -->









    <!-- Mobile Category -->

    <section class="product-tabs section-padding position-relative">
        <div class="container">
            <div class="section-title style-2 wow animate__animated animate__fadeIn">
                <h3>{{ $skip_category_3->category_name }} Category </h3>

            </div>
            <!--End nav-tabs-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                    <div class="row product-grid-4">


                        @foreach($skip_product_3 as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ asset( $product->product_thambnail ) }}" alt="" />

                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" id="{{$product->id}}" onclick="addToWishlist(this.id)" class="action-btn"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn" id="{{$product->id}}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                            <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                        </div>

                                        @php
                                            $amount = $product->selling_price - $product->discount_price;
                                            $discount = ($amount/$product->selling_price) * 100;

                                        @endphp


                                        <div class="product-badges product-badges-position product-badges-mrg">

                                            @if($product->discount_price == NULL)
                                                <span class="new">New</span>
                                            @else
                                                <span class="hot"> {{ round($discount) }} %</span>
                                            @endif


                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $product->product_name }} </a></h2>
                                        <div class="product-rate-cover">
                                            @php
                                                $reviews = \App\Models\Review::where('product_id',$product->id)->get();
                                            @endphp
                                            @if(count($reviews)!=0)
                                                @php
                                                    $avg =$reviews->avg('rating');
                                                @endphp
                                                <span class="font-small ml-5 text-muted">
                                            @for($i=1; $i<=$avg;$i++)
                                                        <span style="color: gold">★</span>
                                                    @endfor
                                                    @for($i=1; $i<=(5-$avg);$i++)
                                                        <span >★</span>
                                                    @endfor</span>
                                            @else
                                                <span class="font-small ml-5 text-muted">
                                                    No Reviews
                                                </span>
                                            @endif
                                        </div>
                                        <div>
                                            @if($product->vendor_id == NULL)
                                                <span class="font-small text-muted">By Owner</span>
                                            @else
                                                <span class="font-small text-muted">By <a href="{{route('vendor.details',$product['vendor']['id'])}}">{{ $product['vendor']['name'] }}</a></span>

                                            @endif



                                        </div>
                                        <div class="product-card-bottom">

                                            @if($product->discount_price == NULL)
                                                <div class="product-price">
                                                    <span>${{ $product->selling_price }}</span>

                                                </div>

                                            @else
                                                <div class="product-price">
                                                    <span>${{ $product->discount_price }}</span>
                                                    <span class="old-price">${{ $product->selling_price }}</span>
                                                </div>
                                            @endif



{{--                                            <div class="add-cart">--}}
{{--                                                <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end product card-->
                        @endforeach





                    </div>
                    <!--End product-grid-4-->
                </div>


            </div>
            <!--End tab-content-->
        </div>


    </section>
    <!--End Mobile Category -->






    <section class="section-padding mb-30">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                    <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                    <div class="product-list-small animated animated">

                        @foreach($hot_deals as $item)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img src="{{ asset( $item->product_thambnail ) }}" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"> {{ $item->product_name }} </a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        @php
                                            $reviews = \App\Models\Review::where('product_id',$item->id)->get();
                                        @endphp
                                        @if(count($reviews)!=0)
                                            @php
                                                $avg =$reviews->avg('rating');
                                            @endphp
                                            <span class="font-small ml-5 text-muted">
                                            @for($i=1; $i<=$avg;$i++)
                                                    <span style="color: gold">★</span>
                                                @endfor
                                                @for($i=1; $i<=(5-$avg);$i++)
                                                    <span >★</span>
                                                @endfor</span>
                                        @else
                                            <span class="font-small ml-5 text-muted">
                                                    No Reviews
                                                </span>
                                        @endif
                                    </div>
                                    @if($item->discount_price == NULL)
                                        <div class="product-price">
                                            <span>${{ $item->selling_price }}</span>

                                        </div>

                                    @else
                                        <div class="product-price">
                                            <span>${{ $item->discount_price }}</span>
                                            <span class="old-price">${{ $item->selling_price }}</span>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach



                    </div>
                </div>




                <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <h4 class="section-title style-1 mb-30 animated animated">  Special Offer </h4>
                    <div class="product-list-small animated animated">


                        @foreach($special_offer as $item)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img src="{{ asset( $item->product_thambnail ) }}" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"> {{ $item->product_name }} </a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        @php
                                            $reviews = \App\Models\Review::where('product_id',$item->id)->get();
                                        @endphp
                                        @if(count($reviews)!=0)
                                            @php
                                                $avg =$reviews->avg('rating');
                                            @endphp
                                            <span class="font-small ml-5 text-muted">
                                            @for($i=1; $i<=$avg;$i++)
                                                    <span style="color: gold">★</span>
                                                @endfor
                                                @for($i=1; $i<=(5-$avg);$i++)
                                                    <span >★</span>
                                                @endfor</span>
                                        @else
                                            <span class="font-small ml-5 text-muted">
                                                    No Reviews
                                                </span>
                                        @endif
                                    </div>
                                    @if($item->discount_price == NULL)
                                        <div class="product-price">
                                            <span>${{ $item->selling_price }}</span>

                                        </div>

                                    @else
                                        <div class="product-price">
                                            <span>${{ $item->discount_price }}</span>
                                            <span class="old-price">${{ $item->selling_price }}</span>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach



                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                    <div class="product-list-small animated animated">


                        @foreach($new as $item)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img src="{{ asset( $item->product_thambnail ) }}" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"> {{ $item->product_name }} </a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        @php
                                            $reviews = \App\Models\Review::where('product_id',$item->id)->get();
                                        @endphp
                                        @if(count($reviews)!=0)
                                            @php
                                                $avg =$reviews->avg('rating');
                                            @endphp
                                            <span class="font-small ml-5 text-muted">
                                            @for($i=1; $i<=$avg;$i++)
                                                    <span style="color: gold">★</span>
                                                @endfor
                                                @for($i=1; $i<=(5-$avg);$i++)
                                                    <span >★</span>
                                                @endfor</span>
                                        @else
                                            <span class="font-small ml-5 text-muted">
                                                    No Reviews
                                                </span>
                                        @endif
                                    </div>
                                    @if($item->discount_price == NULL)
                                        <div class="product-price">
                                            <span>${{ $item->selling_price }}</span>

                                        </div>

                                    @else
                                        <div class="product-price">
                                            <span>${{ $item->discount_price }}</span>
                                            <span class="old-price">${{ $item->selling_price }}</span>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach



                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                    <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                    <div class="product-list-small animated animated">


                        @foreach($special_deals as $item)
                            <article class="row align-items-center hover-up">
                                <figure class="col-md-4 mb-0">
                                    <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"><img src="{{ asset( $item->product_thambnail ) }}" alt="" /></a>
                                </figure>
                                <div class="col-md-8 mb-0">
                                    <h6>
                                        <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $item->product_name }} </a>
                                    </h6>
                                    <div class="product-rate-cover">
                                        @php
                                            $reviews = \App\Models\Review::where('product_id',$item->id)->get();
                                        @endphp
                                        @if(count($reviews)!=0)
                                            @php
                                                $avg =$reviews->avg('rating');
                                            @endphp
                                            <span class="font-small ml-5 text-muted">
                                            @for($i=1; $i<=$avg;$i++)
                                                    <span style="color: gold">★</span>
                                                @endfor
                                                @for($i=1; $i<=(5-$avg);$i++)
                                                    <span >★</span>
                                                @endfor</span>
                                        @else
                                            <span class="font-small ml-5 text-muted">
                                                    No Reviews
                                                </span>
                                        @endif
                                    </div>
                                    @if($item->discount_price == NULL)
                                        <div class="product-price">
                                            <span>${{ $item->selling_price }}</span>

                                        </div>

                                    @else
                                        <div class="product-price">
                                            <span>${{ $item->discount_price }}</span>
                                            <span class="old-price">${{ $item->selling_price }}</span>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach




                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End 4 columns-->



    <!--Vendor List -->

    @include('frontend.home.home_vendor_list')

    <!--End Vendor List -->

@endsection
