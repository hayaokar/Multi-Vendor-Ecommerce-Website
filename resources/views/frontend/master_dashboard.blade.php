

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Easy Shop Online Store </title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        $.ajax({
            type: "POST",
            dataType: "json",
            data:{
                color:color, size:size,quantity:quantity,product_name:product_name
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
        $.ajax({
            type: "POST",
            dataType: "json",
            data:{
                color:color, size:size,quantity:quantity,product_name:product_name
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

    function miniCartRemove($id){
        $.ajax(
            {
                type: "POST",
                dataType: "json",
                url: "/cart/data/miniCartRemove/"+$id,
                success: function (data){
                    miniCart();
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
                }
            }
        )
    }
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
                            <h6><a class="product-name mb-10" href="shop-product-right.html">${value.product.product_name} </a></h6>
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
                    name+=`<td class="product_name">
                                <h6><a href="shop-product-full.html" class="text-heading">${value.product.product_name}</a></h6>
                        </td>`
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

</script>






</body>

</html>
