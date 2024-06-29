<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\backend\BrandController;
use Illuminate\Support\Facades\Route;

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




//Admin dashboard
Route::middleware(['auth','role:admin'])->group(function (){
    Route::get('/admin/dashboard/',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout/',[AdminController::class,'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile/',[AdminController::class,'AdminProfile'])->name('admin.profile');
    Route::post('/admin/store/profile/',[AdminController::class,'AdminStoreProfile'])->name('admin.profile.store');
    Route::get('/admin/change/password/',[AdminController::class,'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/store/password/',[AdminController::class,'AdminStorePassword'])->name('update.password');

});

//Vendor dashboard
Route::middleware(['auth','role:vendor'])->group(function (){
    Route::get('/vendor/dashboard/',[VendorController::class,'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout/',[VendorController::class,'VendorLogout'])->name('vendor.logout');
    Route::get('/vendor/profile/',[VendorController::class,'VendorProfile'])->name('vendor.profile');
    Route::post('/vendor/store/profile/',[VendorController::class,'VendorStoreProfile'])->name('vendor.profile.store');
    Route::get('/vendor/change/password/',[VendorController::class,'VendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/store/password/',[VendorController::class,'VendorStorePassword'])->name('vendor.update.password');
});

Route::middleware(['auth'])->group(function (){
    Route::get('/dashboard',[UserController::class,'UserDashboard'])->name('user.dashboard');
    Route::post('/user/store/profile/',[UserController::class,'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout/',[UserController::class,'UserLogout'])->name('user.logout');
    Route::post('/user/change/password/',[UserController::class,'UserChangePassword'])->name('user.change.password');
});

//All Brand Routes
Route::middleware(['auth','role:admin'])->group(function (){
    Route::controller(BrandController::class)->group(function (){
        Route::get('/all/brand','AllBrand')->name('all.brand');
        Route::get('/add/brand','AddBrand')->name('add.brand');
        Route::post('/add/brand','StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}','EditBrand')->name('edit.brand');
        Route::post('/edit/brand/','UpdateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}','DeleteBrand')->name('delete.brand');
    });
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin']);
Route::get('/vendor/login', [VendorController::class, 'VendorLogin']);

require __DIR__.'/auth.php';
