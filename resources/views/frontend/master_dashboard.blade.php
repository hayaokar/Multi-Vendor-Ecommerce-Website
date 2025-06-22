

<!DOCTYPE html>
<html class="no-js" lang="en">
@php
    $seo = App\Models\Seo::find(1);
@endphp
<head>
    <meta charset="utf-8" />
    <title> @yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="title" content="{{ $seo->meta_title }}" />
    <meta name="author" content="{{ $seo->meta_author }}" />
    <meta name="keywords" content="{{ $seo->meta_keyword }}" />
    <meta name="description" content="{{ $seo->meta_description }}" />
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
<!-- Modal -->

<!-- Quick view -->
@include('frontend.body.quick_view')
<!-- Header  -->

@include('frontend.body.header')
<!--End header-->



<main class="main">
    @yield('main')

</main>

@include('frontend.body.footer')



<!-- Preloader Start -->
<div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
            </div>
        </div>
    </div>
</div>
<!-- Vendor JS-->
<script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
<!-- Template  JS -->
<script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
<script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>
{{--<script src="{{ asset('frontend/assets/js/script.js') }}"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif
</script>
<script type="text/javascript">

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })

    function productView(id){
       $.ajax({
           type: 'GET',
           url: '/product/view/modal/'+id,
           dataType: 'json',
           success:function (data){
               $('#pname').text(data.product.product_name);
               $('#pprice').text(data.product.selling_price);
               $('#pcode').text(data.product.product_code);
               $('#pvendor_id').text(data.vendor);
               $('#pcategory').text(data.product.category.category_name);
               $('#pbrand').text(data.product.brand.brand_name);
               $('#pimage').attr('src','/'+data.product.product_thambnail);
               $('#product_id').val(id);
               $('#qty').val(1);
               if(data.product.discount_price == null){
                   $('#pprice').text('');
                   $('#oldprice').text('');
                   $('#pprice').text(data.product.selling_price);
               }else {
                   $('#pprice').text(data.product.discount_price);
                   $('#oldprice').text(data.product.selling_price);
               }
               if(data.product.product_qty > 0 ){
                   $('#aviable').text('');
                   $('#stockout').text('');
                   $('#aviable').text('Available');
               }else{
                   $('#aviable').text('');
                   $('#stockout').text('');
                   $('#stockout').text('Stockout');
               }
               $('select[name="size"]').empty();
               $.each(data.size,function (key,value){
                   $('select[name="size"]').append('<option value="'+value+'">'+value+'</option>');
                   if(data.size == ""){
                       $('#sizeArea').hide();
                   }else {
                       $('#sizeArea').show();
                   }
               })
               $('select[name="color"]').empty();
               $.each(data.color,function (key,value){
                   $('select[name="color"]').append('<option value="'+value+'">'+value+'</option>');
                   if(data.color == ""){
                       $('#colorArea').hide();
                   }else {
                       $('#colorArea').show();
                   }
               })
           }
       })
    }
    function addToCart(){
        //alert("hooooo")
        var product_name = $('#pname').text();
        var id = $('#product_id').val();
        var color = $('#color option:selected').text();
        var size = $('#size option:selected').text();
        var quantity = $('#qty').val();
        var vendor = $('#pvendor_id').text();
        $.ajax({
            type: "POST",
            dataType: "json",
            data:{
                color:color, size:size,quantity:quantity,product_name:product_name,vendor:vendor
            },
            url: "/cart/data/store/"+id,
            success:function (data){
                miniCart()
                $('#closeModal').click();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'success',
                        title: data.error,
                    })
                }
                console.log(data)
            }
        })
    }
    function addToCartDetailed(){
        //alert("hooooo")
        var product_name = $('#dpname').text();
        var id = $('#dproduct_id').val();
        var color = $('#dcolor option:selected').text();
        var size = $('#dsize option:selected').text();
        var quantity = $('#dqty').val();
        var vendor = $('#vendor_id').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            data:{
                color:color, size:size,quantity:quantity,product_name:product_name,vendor:vendor
            },
            url: "/cart/data/store/"+id,
            success:function (data){
                miniCart()
                $('#closeModal').click();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'success',
                        title: data.error,
                    })
                }
                console.log(data)
            }
        })
    }
    function miniCart(){
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/cart/data/miniCart",
            success:function (response){
                $('#cartQty').text(response.cartQty);
                $('#cartTotal').text(response.cartTotal);

                var miniCart = "";
                $.each(response.carts,function (key,value){
                    miniCart += `
                    <ul>
            <li>
                <div class="shopping-cart-img">
                    <a href="shop-product-right.html"><img alt="Nest" src="/${value.options.image} " style="width:50px;height:50px;" /></a>
                </div>
                <div class="shopping-cart-title" style="margin: -73px 74px 14px; width" 146px;>
                    <h4><a href="shop-product-right.html"> ${value.name} </a></h4>
                    <h4><span>${value.qty} × </span>${value.price}</h4>
                </div>
                <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                    <a id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fi-rs-cross-small"></i></a>
                </div>
            </li>
        </ul>
        <hr><br>
                    `
                })
                $('#miniCart').html(miniCart);
            }
        })
    }
    miniCart();


    function addToWishlist(id){
        $.ajax(
            {
                type: "POST",
                dataType: "json",
                url: "/add-to-wishlist/"+id,
                success: function (data){
                    wishlist();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        showCloseButton: true,
                    })
                    if($.isEmptyObject(data.error)){
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })
                    }else{
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,

                        })
                    }
                }
            }
        )
    }
    function wishlist(){
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/get-wishlist-product/",

            success:function(response){
                $('#countWish').text(response.wishQty);
                var rows = ""
                $.each(response.wishlist, function(key,value){

                    rows += `<tr class="pt-30">
                        <td class="custome-checkbox pl-30">

                        </td>
                        <td class="image product-thumbnail pt-40"><img src="/${value.product.product_thambnail}" alt="#" /></td>
                        <td class="product-des product-name">
                            <h6><a class="product-name mb-10" href="/product/details/${value.product.id}/${value.product.product_slug}">${value.product.product_name} </a></h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                        </td>
                        <td class="price" data-title="Price">
                        ${value.product.discount_price == null
                        ? `<h3 class="text-brand">$${value.product.selling_price}</h3>`
                        :`<h3 class="text-brand">$${value.product.discount_price}</h3>`

                    }

                        </td>
                        <td class="text-center detail-info" data-title="Stock">
                            ${value.product.product_qty > 0
                        ? `<span class="stock-status in-stock mb-0"> In Stock </span>`

                        :`<span class="stock-status out-stock mb-0">Stock Out </span>`

                    }

                        </td>

                        <td class="action text-center" data-title="Remove">
                            <a id="${value.id}" onclick="wishlistRemove(this.id)" class="text-body"><i class="fi-rs-trash"></i></a>
                        </td>
                    </tr> `

                });

                $('#wishlist').html(rows);

            }
        })
    }

    wishlist();
    function wishlistRemove(id){
        $.ajax({
            url: '/remove-wishlist-product/'+ id,
            type:"POST",
            dataType: "json",
            success: function (data){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                        showCancelButton: true
                    })
                }
                wishlist();
            }

        })
    }

    function addToCompare(id){
        $.ajax(
            {
                type: "POST",
                dataType: "json",
                url: "/add-to-compare/"+id,
                success: function (data){
                    compare()
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        showCloseButton: true,
                    })
                    if($.isEmptyObject(data.error)){
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })
                    }else{
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,

                        })
                    }
                }
            }
        )
    }
    function compare(){
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/get-compare-product/",

            success:function(response){
                $('#compCount').text(response.compQty);
                var rows = ""
                var img = `<tr class="pr_image"><td class="text-muted font-sm fw-600 font-heading mw-200">Preview</td>`
                var name = `<tr class="pr_title"><td class="text-muted font-sm fw-600 font-heading">Name</td>`
                var price = `<tr class="pr_price"><td class="text-muted font-sm fw-600 font-heading">Price</td>`
                var desc = `<tr class="description"><td class="text-muted font-sm fw-600 font-heading">Description</td>`
                var qty = `<tr class="pr_stock"><td class="text-muted font-sm fw-600 font-heading">Stock status</td>`
                var remove = `<tr class="pr_remove text-muted"><td class="text-muted font-md fw-600"></td>`
                $.each(response.compare, function(key,value){
                    img+=`<td class="row_img"><img src="/${value.product.product_thambnail}" alt="compare-img" style="width: 300px;width: 300px" /></td>`
                    name += `<td class="product_name"><h6><a href="/product/details/${value.product.id}/${value.product.product_slug}" class="text-heading">${value.product.product_name}</a></h6></td>`;

                    price+=`<td class="product_price">
                            ${value.product.discount_price == null
                        ? `<h3 class="text-brand">$${value.product.selling_price}</h3>`
                        :`<h3 class="text-brand">$${value.product.discount_price}</h3>`

                    }
                        </td>`
                    desc+=`
                        <td class="row_text font-xs">
                            <p class="font-sm text-muted">${value.product.short_descp}</p>
                        </td>

                    `
                    qty+=`<td class="row_stock"> ${value.product.product_qty > 0
                        ? `<span class="stock-status in-stock mb-0"> In Stock </span>`

                        :`<span class="stock-status out-stock mb-0">Stock Out </span>`

                    }</td>`
                    remove+=`<td class="row_remove">
                            <a id="${value.id}" onclick="compareRemove(this.id)" class="text-muted"><i class="fi-rs-trash mr-5"></i><span>Remove</span> </a>
                        </td>`
                });
                img+=`</tr>`
                name+=`</tr>`
                price+=`</tr>`
                desc+=`</tr>`
                qty+=`</tr>`
                remove+=`</tr>`
                rows = img + name + price + desc + qty + remove
                $('#compare').html(rows);

            }
        })
    }
    compare();
    function compareRemove(id){
        $.ajax({
            url: '/remove-compare-product/'+ id,
            type:"POST",
            dataType: "json",
            success: function (data){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                        showCancelButton: true
                    })
                }
                compare();
            }

        })
    }
    function myCart(){
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/cart/data/miniCart",
            success:function (response){

                var rows = "";
                $.each(response.carts,function (key,value){
                    rows += `
                    <tr class="pt-30">
                            <td class="custome-checkbox pl-30">

                            </td>
                            <td class="image product-thumbnail pt-40"><img src="${value.options.image}" alt="#"></td>
                            <td class="product-des product-name">
                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.html">${value.name}</a></h6>

                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-body">$${value.price} </h4>
                            </td>

                            <td class="price" data-title="Price">
                                ${value.options.color == null
                        ? `<span>.... </span>`
                        : `<h6 class="text-body">${value.options.color} </h6>`
                    }
                            </td>

                            <td class="price" data-title="Price">
                                ${value.options.size == null
                        ? `<span>.... </span>`
                        : `<h6 class="text-body">${value.options.size} </h6>`
                    }
                            </td>
                            <td class="text-center detail-info" data-title="Stock">
                                <div class="detail-extralink mr-15">
                                    <div class="detail-qty border radius">
                                        <a onclick="cartDecrement(this.id)" id="${value.rowId}" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">
                                        <a onclick="cartIncrement(this.id)" id="${value.rowId}"class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td class="price" data-title="Price">
                                <h4 class="text-brand">$${value.subtotal}</h4>
                            </td>
                            <td class="action text-center" data-title="Remove"><a onclick="miniCartRemove(this.id)" id="${value.rowId}" class="text-body"><i class="fi-rs-trash"></i></a></td>
                        </tr>
                    `
                })
                $('#cart').html(rows);
            }
        })
    }
    myCart();
    function cartDecrement(id){
        $.ajax(
            {
                type:"POST",
                dataType: "json",
                url: "/cart/data/qtyDecrement/"+id,
                success:function (response){
                    totalCalculation()
                    myCart();
                    miniCart();
                }
            }
        )
    }
    function cartIncrement(id){
        $.ajax(
            {
                type:"POST",
                dataType: "json",
                url: "/cart/data/qtyIncrement/"+id,
                success:function (response){
                    totalCalculation()
                    myCart();
                    miniCart();
                }
            }
        )
    }
    function miniCartRemove($id){
        $.ajax(
            {
                type: "POST",
                dataType: "json",
                url: "/cart/data/miniCartRemove/"+$id,
                success: function (data){

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000,
                        showCloseButton: true,
                    })
                    if($.isEmptyObject(data.error)){
                        Toast.fire({
                            type: 'success',
                            title: data.success,

                        })
                        totalCalculation();
                        miniCart();
                        myCart();
                    }else{
                        Toast.fire({
                            type: 'success',
                            title: data.error,
                        })
                    }
                }
            }
        )
    }

    function applyCoupon(){
        var coupon_name = $('#coupon').val()
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {coupon_name: coupon_name},
            url: '/applyCoupon',
            success: function (data){
                if (data.validity == true) {
                    $('#couponField').hide();
                    totalCalculation();
                }
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                        showCancelButton: true
                    })
                }
            }
        })
    }
    function totalCalculation(){
        $.ajax({
            type:"GET",
            dataType: "json",
            url: "/total-calculation",
            success: function (data){
                if(data.total){
                    $('#couponCalField').html(`<tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${data.total}$</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">${data.total}$</h4>
                                        </td>
                                    </tr>`)
                }else{
                    $('#couponCalField').html(`<tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Subtotal</h6>
                    </td>
                    <td class="cart_total_amount">
                        <h4 class="text-brand text-end">$${data.subtotal}</h4>
                    </td>
                </tr>

                <tr>
                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupon</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h6 class="text-brand text-end">${data.coupon_name} <a onclick="removeCoupon()"><i class="fi-rs-trash"></i> </a> </h6>
                                        </td>
                                    </tr>
                                        <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Discount Amount  </h6>
                    </td>
                    <td class="cart_total_amount">
    <h4 class="text-brand text-end">$${data.discount_amount}</h4>
                    </td>
                </tr>
                <tr>
                    <td class="cart_total_label">
                        <h6 class="text-muted">Grand Total </h6>
                    </td>
                    <td class="cart_total_amount">
          <h4 class="text-brand text-end">$${data.total_amount}</h4>
                    </td>
                </tr> `)
                }
            }
        })
    }
    totalCalculation()
    function removeCoupon(){
        $.ajax({
            url:'/remove-coupon',
            dataType:'json',
            type:'GET',
            success: function (data){
                totalCalculation();
                $('#couponField').show();
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                        showCancelButton: true
                    })
                }
            }
        })
    }

    $("#search").on('keyup',function (){
        if(($(this).val()).length>2){
            let serach = $(this).val()
            $.ajax({
                type:"POST",
                datatype: "JSON",
                url:"/search-ajax",
                data:{
                    "search":serach
                },
                success: function (data){
                    console.log(data)

                    if(data.length){
                        html = ''
                        $.each(data,function (key,value){
                            html +=  '<a href="'+baseUrl+'/product/details/'+value.id+'/'+value.product_slug+'">'+
                                '<div class="list border-bottom">'+
                                '<div class="row">'+

                                '<div class="col-md-2">'+

                                '<img src="'+baseUrl+'/'+value.product_thambnail+'" style="width:40px; height:40px">'+
                                '</div>'+
                                '<div class="col-md-10">'+
                                ' <div class="d-flex flex-column ml-5">'+
                                ' <span>'+value.product_name+'</span> <small>$'+value.selling_price+'</small>'+

                                '</div>'+
                                '</div>'+

                                ' </div>'+
                                '</div>'+
                                '</a>'
                        });
                    }else{
                        html = '<span class="text-center text-muted">No products found</span>'
                    }
                    $('#result-info').html(html)

                }

            })
        }
    });

</script>






</body>

</html>
