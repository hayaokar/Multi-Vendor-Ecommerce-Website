<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\backend\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;
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

Route::get('/', function () {
    return view('frontend.index');
})->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});






//Vendor dashboard
Route::middleware(['auth','role:vendor'])->group(function (){
    Route::get('/vendor/dashboard/',[VendorController::class,'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout/',[VendorController::class,'VendorLogout'])->name('vendor.logout');
    Route::get('/vendor/profile/',[VendorController::class,'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/store/profile/',[VendorController::class,'VendorStoreProfile'])->name('vendor.profile.store');
    Route::get('/vendor/change/password/',[VendorController::class,'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/store/password/',[VendorController::class,'VendorStorePassword'])->name('vendor.update.password');

    Route::controller(VendorProductController::class)->group(function (){
        Route::get('/vendor/all/product','VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/product','VendorAddProduct')->name('vendor.add.product');
        Route::get('/vendor/subcategory/ajax/{id}','VendorGetSubCategory');
        Route::post('/vendor/add/products','VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/products/{id}','VendorEditProduct')->name('vendor.edit.product');
        Route::post('/vendor/update/product' , 'VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/vendor/update/product/thambnail' , 'VendorUpdateProductThambnail')->name('vendor.update.product.thambnail');
        Route::post('/vendor/update/product/multiimage' , 'VendorUpdateProductMultiimage')->name('vendor.update.product.multiimage');
        Route::get('/vendor/product/multiimg/delete/{id}','VendorMultiImageDelete')->name('vendor.product.multimage.delete');
        Route::get('/vendor/product/inactive/{id}','VendorProductInactive')->name('vendor.product.inactive');
        Route::get('/vendor/product/active/{id}','VendorProductActive')->name('vendor.product.active');
        Route::get('/vendor/delete/product/{id}','VendorDeleteProduct')->name('vendor.delete.product');
    });
});

Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard',[UserController::class,'UserDashboard'])->name('user.dashboard');
    Route::post('/user/store/profile/',[UserController::class,'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout/',[UserController::class,'UserLogout'])->name('user.logout');
    Route::post('/user/change/password/',[UserController::class,'UserChangePassword'])->name('user.change.password');
});

//All Brand Routes
Route::middleware(['auth','role:admin'])->group(function (){
    Route::get('/admin/dashboard/',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout/',[AdminController::class,'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile/',[AdminController::class,'AdminProfile'])->name('admin.profile');
    Route::post('/admin/store/profile/',[AdminController::class,'AdminStoreProfile'])->name('admin.profile.store');
    Route::get('/admin/change/password/',[AdminController::class,'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/store/password/',[AdminController::class,'AdminStorePassword'])->name('update.password');

    Route::controller(BrandController::class)->group(function (){
        Route::get('/all/brand','AllBrand')->name('all.brand');
        Route::get('/add/brand','AddBrand')->name('add.brand');
        Route::post('/add/brand','StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}','EditBrand')->name('edit.brand');
        Route::post('/edit/brand/','UpdateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}','DeleteBrand')->name('delete.brand');
    });

    Route::controller(CategoryController::class)->group(function (){
        Route::get('/all/category','AllCategory')->name('all.category');
        Route::get('/add/category','AddCategory')->name('add.category');
        Route::post('/add/category','StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}','EditCategory')->name('edit.category');
        Route::post('/edit/category/','UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}','DeleteCategory')->name('delete.category');
    });

    Route::controller(SubCategoryController::class)->group(function (){
        Route::get('/all/subcategory','AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory','AddSubCategory')->name('add.subcategory');
        Route::post('/add/subcategory','StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}','EditSubCategory')->name('edit.subcategory');
        Route::post('/edit/subcategory/','UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}','DeleteSubCategory')->name('delete.subcategory');
        Route::get('/subcategory/ajax/{id}','GetSubCategory');
    });

    Route::controller(AdminController::class)->group(function (){
        Route::get('inactive/vendor','InactiveVendor')->name('inactive.vendor');
        Route::get('active/vendor','ActiveVendor')->name('active.vendor');
        Route::get('activate/vendor/{id}','ActivateVendor')->name('activate.vendor');
        Route::get('deactivate/vendor/{id}','DeActivateVendor')->name('deactivate.vendor');
    });

    Route::controller(ProductController::class)->group(function (){
        Route::get('/all/products','AllProduct')->name('all.product');
        Route::get('/add/products','AddProduct')->name('add.product');
        Route::post('/add/products','StoreProduct')->name('store.product');
        Route::post('/update/product/thambnail' , 'UpdateProductThambnail')->name('update.product.thambnail');
        Route::post('/update/product/multiimage' , 'UpdateProductMultiimage')->name('update.product.multiimage');
        Route::post('/update/product' , 'UpdateProduct')->name('update.product');
        Route::get('/edit/products/{id}','EditProduct')->name('edit.product');
        Route::get('/product/multiimg/delete/{id}','MultiImageDelete')->name('product.multimage.delete');
        Route::get('/product/inactive/{id}','ProductInactive')->name('product.inactive');
        Route::get('/product/active/{id}','ProductActive')->name('product.active');
        Route::get('/delete/product/{id}','DeleteProduct')->name('delete.product');
    });

    //Slider Routes
    Route::controller(SliderController::class)->group(function (){
        Route::get('/all/slider','AllSliders')->name('all.sliders');
        Route::get('/add/slider','AddSlider')->name('add.slider');
        Route::post('/add/slider','StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}','EditSlider')->name('edit.slider');
        Route::post('/edit/slider/','UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}','DeleteSlider')->name('delete.slider');
    });

    //Banner Routes
    Route::controller(BannerController::class)->group(function (){
        Route::get('/all/banners','AllBanners')->name('all.banners');
        Route::get('/add/banner','AddBanner')->name('add.banner');
        Route::post('/add/banner','StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}','EditBanner')->name('edit.banner');
        Route::post('/edit/banner/','UpdateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}','DeleteBanner')->name('delete.banner');
    });
});
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminController::class, 'AdminLogin']);
    Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('login.vendor');
});

Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/register/vendor', [VendorController::class, 'RegisterVendor'])->name('register.vendor');

require __DIR__.'/auth.php';
