<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BlogPostController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\Wishlist;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Baxkend\ReportController;
use App\Http\Controllers\VendorOrderController;
use App\Http\Controllers\wishlistController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\BlogPost;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',  [IndexController::class, 'Index'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



//Vendor dashboard
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard/', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout/', [VendorController::class, 'VendorLogout'])->name('vendor.logout');
    Route::get('/vendor/profile/', [VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/store/profile/', [VendorController::class, 'VendorStoreProfile'])->name('vendor.profile.store');
    Route::get('/vendor/change/password/', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/store/password/', [VendorController::class, 'VendorStorePassword'])->name('vendor.update.password');

    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/vendor/all/product', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/product', 'VendorAddProduct')->name('vendor.add.product');
        Route::get('/vendor/subcategory/ajax/{id}', 'VendorGetSubCategory');
        Route::post('/vendor/add/products', 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/products/{id}', 'VendorEditProduct')->name('vendor.edit.product');
        Route::post('/vendor/update/product', 'VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/vendor/update/product/thambnail', 'VendorUpdateProductThambnail')->name('vendor.update.product.thambnail');
        Route::post('/vendor/update/product/multiimage', 'VendorUpdateProductMultiimage')->name('vendor.update.product.multiimage');
        Route::get('/vendor/product/multiimg/delete/{id}', 'VendorMultiImageDelete')->name('vendor.product.multimage.delete');
        Route::get('/vendor/product/inactive/{id}', 'VendorProductInactive')->name('vendor.product.inactive');
        Route::get('/vendor/product/active/{id}', 'VendorProductActive')->name('vendor.product.active');
        Route::get('/vendor/delete/product/{id}', 'VendorDeleteProduct')->name('vendor.delete.product');
    });
    Route::controller(VendorOrderController::class)->group(function () {
        Route::get('/vendor/orders', 'VendorOrders')->name('vendor.orders');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    Route::post('/user/store/profile/', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout/', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::post('/user/change/password/', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::get('/user/change/password/view', [UserController::class, 'UserChangePasswordView'])->name('user.password');
    Route::get('/user/account/details', [UserController::class, 'UserAccountDetails'])->name('user.account.details');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/user/orders/', [UserController::class, 'UserOrders'])->name('user.orders');
    Route::get('/view/order/{order}', [UserController::class, 'ViewOrder'])->name('view.order');
    Route::get('/invoice/order/{order}', [UserController::class, 'InvoiceOrder'])->name('invoice.order');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard/', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout/', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile/', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/store/profile/', [AdminController::class, 'AdminStoreProfile'])->name('admin.profile.store');
    Route::get('/admin/change/password/', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/store/password/', [AdminController::class, 'AdminStorePassword'])->name('update.password');

    //All Brand Routes
    Route::controller(BrandController::class)->group(function () {
        Route::get('/all/brand', 'AllBrand')->name('all.brand');
        Route::get('/add/brand', 'AddBrand')->name('add.brand');
        Route::post('/add/brand', 'StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit.brand');
        Route::post('/edit/brand/', 'UpdateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}', 'DeleteBrand')->name('delete.brand');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/add/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/edit/category/', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'AddSubCategory')->name('add.subcategory');
        Route::post('/add/subcategory', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/edit/subcategory/', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');
        Route::get('/subcategory/ajax/{id}', 'GetSubCategory');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('inactive/vendor', 'InactiveVendor')->name('inactive.vendor');
        Route::get('active/vendor', 'ActiveVendor')->name('active.vendor');
        Route::get('activate/vendor/{id}', 'ActivateVendor')->name('activate.vendor');
        Route::get('deactivate/vendor/{id}', 'DeActivateVendor')->name('deactivate.vendor');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/products', 'AllProduct')->name('all.product');
        Route::get('/add/products', 'AddProduct')->name('add.product');
        Route::post('/add/products', 'StoreProduct')->name('store.product');
        Route::post('/update/product/thambnail', 'UpdateProductThambnail')->name('update.product.thambnail');
        Route::post('/update/product/multiimage', 'UpdateProductMultiimage')->name('update.product.multiimage');
        Route::post('/update/product', 'UpdateProduct')->name('update.product');
        Route::get('/edit/products/{id}', 'EditProduct')->name('edit.product');
        Route::get('/product/multiimg/delete/{id}', 'MultiImageDelete')->name('product.multimage.delete');
        Route::get('/product/inactive/{id}', 'ProductInactive')->name('product.inactive');
        Route::get('/product/active/{id}', 'ProductActive')->name('product.active');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
    });

    //Slider Routes
    Route::controller(SliderController::class)->group(function () {
        Route::get('/all/slider', 'AllSliders')->name('all.sliders');
        Route::get('/add/slider', 'AddSlider')->name('add.slider');
        Route::post('/add/slider', 'StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
        Route::post('/edit/slider/', 'UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');
    });

    //Banner Routes
    Route::controller(BannerController::class)->group(function () {
        Route::get('/all/banners', 'AllBanners')->name('all.banners');
        Route::get('/add/banner', 'AddBanner')->name('add.banner');
        Route::post('/add/banner', 'StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}', 'EditBanner')->name('edit.banner');
        Route::post('/edit/banner/', 'UpdateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    });

    Route::controller(CouponController::class)->group(function () {
        Route::get('/all/coupons', 'AllCoupons')->name('all.coupons');
        Route::get('/add/coupon', 'AddCoupon')->name('add.coupon');
        Route::post('/add/coupon', 'StoreCoupon')->name('store.coupon');
        Route::get('/edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
        Route::post('/edit/coupon/', 'UpdateCoupon')->name('update.coupon');
        Route::get('/delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');
    });

    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/divisions', 'AllDivisions')->name('all.divisions');
        Route::get('/ajax/all/divisions', 'GetAllDivisions');
        Route::get('/view/division/{id}', 'ViewDivision');
        Route::post('/add/divisions', 'AddDivisions')->name('store.division');
        Route::post('/update/divisions/{id}', 'UpdateDivisions');
        Route::get('/delete/division/{id}', 'DeleteDivision')->name('delete.division');
    });
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/ajax/all/districts', 'GetAllDistricts');
        Route::get('/all/districts', 'AllDistricts')->name('all.districts');
        Route::get('/view/district/{id}', 'ViewDistrict');
        Route::post('/add/district', 'AddDistrict')->name('store.district');
        Route::post('/update/district/{id}', 'UpdateDistrict');
        Route::get('/delete/district/{id}', 'DeleteDistrict')->name('delete.district');
    });
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/state', 'AllState')->name('all.states');
        Route::get('/add/state', 'AddState')->name('add.state');
        Route::get('/district/ajax/{division_id}', 'GetDistrict');
        Route::post('/add/state', 'StoreState')->name('store.state');

        Route::get('/edit/state/{id}', 'EditState')->name('edit.state');
        Route::post('/update/state', 'UpdateState')->name('update.state');
        Route::get('/delete/state/{id}', 'DeleteState')->name('delete.state');
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('/pending/orders', 'PendingOrders')->name('pending.orders');
        Route::get('/confirmed/orders', 'ConfirmedOrders')->name('confirmed.orders');
        Route::get('/processing/orders', 'ProcessingOrders')->name('processing.orders');
        Route::get('/delivered/orders', 'DeliveredOrders')->name('delivered.orders');
        Route::get('/admin/order/{order}', 'OrderDetails')->name('admin.order.details');
        Route::get('/admin/order/confirm/{order}', 'OrderConfirm')->name('admin.order.confirm');
        Route::get('/admin/order/process/{order}', 'OrderProcess')->name('admin.order.processed');
        Route::get('/admin/order/deliver/{order}', 'OrderDeliver')->name('admin.order.delivered');
    });
    Route::controller(ReportController::class)->group(function(){
        Route::get('/reports', 'ReportView')->name('report.view');
        Route::get('/reports/search/date', 'SearchByDate')->name('search-by-date');
        Route::get('/reports/search/month', 'SearchByMonth')->name('search-by-month');
        Route::get('/reports/search/year', 'SearchByYear')->name('search-by-year');
        Route::get('/reports/search/user', 'SearchByUser')->name('search-by-user');
    });
    Route::controller(ActiveUserController::class)->group(function (){
        Route::get('/customers','allCustomers')->name('customers.view');
        Route::get('/vendors','allVendors')->name('vendors.view');
    });
    Route::controller(BlogController::class)->group(function (){
        Route::get('/admin/blog/category','allCategories')->name('admin.blog.category');
        Route::get('/admin/blog/category/add','addCategories')->name('admin.blog.category.add');
        Route::post('/admin/blog/category/store','storeCategory')->name('admin.blog.category.store');
        Route::get('/admin/blog/category/edit/{category}','editCategory')->name('admin.blog.category.edit');
        Route::post('/admin/blog/category/update/{id}','updateCategory')->name('admin.blog.category.update');
        Route::get('/admin/blog/category/delete/{category}','deleteCategory')->name('admin.blog.category.delete');
    });
    Route::controller(BlogPostController::class)->group(function (){
        Route::get('/admin/blog/post','allPosts')->name('admin.blog.post');
        Route::get('/admin/blog/post/add','addPost')->name('admin.blog.post.add');
        Route::post('/admin/blog/post/store','storePost')->name('admin.blog.post.store');
        Route::get('/admin/blog/post/edit/{post}','editPost')->name('admin.blog.post.edit');
        Route::post('/admin/blog/post/update','updatePost')->name('admin.blog.post.update');
        Route::get('/admin/blog/post/delete/{post}','deletePost')->name('admin.blog.post.delete');
    });
});
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'AdminLogin']);
    Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('login.vendor');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::controller(wishlistController::class)->group(function () {
        Route::get('/myWishlist', 'Wishlist')->name('all.wishlist');
        Route::post('/remove-wishlist-product/{id}', 'RemoveWishlistProduct');
    });
    Route::controller(CompareController::class)->group(function () {
        Route::get('/compare', 'Compare')->name('compare');
        Route::post('/remove-compare-product/{id}', 'RemoveCompareProduct');
    });

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/city-get/ajax/{country_id}', 'CityGetAjax');
        Route::post('/checkout/store', 'CheckoutStore')->name('checkout.store');
    });
});

Route::controller(CartController::class)->group(function () {
    Route::get('/mycart', 'MyCart')->name('mycart');
    Route::post('/cart/data/qtyDecrement/{id}', 'qtyDecrement');
    Route::post('/cart/data/qtyIncrement/{id}', 'qtyIncrement');
    Route::post('/applyCoupon', 'ApplyCoupon');
    Route::get('/total-calculation', 'totalCalculation');
    Route::get('/remove-coupon', 'removeCoupon');
    Route::get('/checkout', 'checkoutCreate')->name('checkout');
});
Route::controller(StripeController::class)->group(function () {
    Route::post('/stripe/order', 'StripeOrder')->name('stripe.order');
    Route::post('/cash/order', 'CashOrder')->name('cash.order');
});

//Blog Home Routes 
Route::controller(BlogPostController::class)->group(function () {
    Route::get('/blog', 'homeBlog')->name('home.blog');
    Route::get('/blog/{id}/{slug}', 'homeBlogDetails')->name('home.blog.details');
    Route::get('/blog/category/{id}/{slug}', 'homeCategoryBlogs')->name('home.category.blogs');
});
//Frontend Product Details All Routes
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
Route::get('/vendor/details/{id}', [IndexController::class, 'vendorDetails'])->name('vendor.details');
Route::get('/vendor/all', [IndexController::class, 'vandorAll'])->name('vendor.all');
Route::get('/product/category/{id}/{slug}', [IndexController::class, 'catWiseProduct']);
Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'subCatWiseProduct']);
Route::get('/product/view/modal/{id}', [IndexController::class, 'productViewAjax']);
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
Route::get('/cart/data/miniCart', [CartController::class, 'miniCart']);
Route::post('/cart/data/miniCartRemove/{id}', [CartController::class, 'miniCartRemove']);
Route::post('/add-to-wishlist/{id}', [wishlistController::class, 'addToWishlist']);
Route::get('/get-wishlist-product', [wishlistController::class, 'GetWishlistProduct']);
Route::get('/get-compare-product', [CompareController::class, 'GetCompareProduct']);
Route::post('/add-to-compare/{id}', [CompareController::class, 'addToCompare']);
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/register/vendor', [VendorController::class, 'RegisterVendor'])->name('register.vendor');

require __DIR__ . '/auth.php';
