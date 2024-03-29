<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryControll;
use App\Http\Controllers\Admin\CouponControll;
use App\Http\Controllers\Admin\SizeControll;
use App\Http\Controllers\Admin\ColorControll;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TaxsController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductReviews;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Front\FrontController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





//Admin Route Set Start

Route::get('/admin',[AdminController::class, 'index'])->name('admin');
Route::post('/admin/auth',[AdminController::class, 'auth'])->name('admin.auth');
Route::get('/admin/reg',[AdminController::class, 'register'])->name('admin.reg');
Route::post('/admin/reg',[AdminController::class, 'store'])->name('admin.reg');

Route::group(['middleware'=>'admin_auth'], function(){
    Route::get('logout', function(){
        session()->pull('ADMIN_ID');
        return redirect('admin');
    } );
    Route::get('dashboard', function(){
        return view('admin_login/dashboard');
    });
    Route::get('category', [CategoryControll::class, 'index']);
    Route::get('category_add', [CategoryControll::class, 'category_add']);
    Route::post('category_insert', [CategoryControll::class, 'insert'])->name('category_insert');
    Route::get('category_update/{id}', [CategoryControll::class, 'update']);
    Route::post('category_updatedata/{id}', [CategoryControll::class, 'updatedata']);
    Route::get('category_delete/{id}', [CategoryControll::class, 'delete']);
    Route::get('status_update/{status}/{category_id}', [CategoryControll::class, 'status']);

    Route::get('coupon', [CouponControll::class, 'index']);
    Route::get('coupon_add', [CouponControll::class, 'coupon_add']);
    Route::post('coupon_insert', [CouponControll::class, 'insert'])->name('coupon_insert');
    Route::get('coupon_update/{id}', [CouponControll::class, 'update']);
    Route::post('coupon_updatedata/{id}', [CouponControll::class, 'updatedata']);
    Route::get('coupon_delete/{id}', [CouponControll::class, 'delete']);
    Route::get('status_update_coupon/{status}/{id}', [CouponControll::class, 'status']);

    Route::get('size', [SizeControll::class, 'index']);
    Route::get('size_add', [SizeControll::class, 'size_add']);
    Route::post('size_insert', [SizeControll::class, 'insert'])->name('size_insert');
    Route::get('size_update/{id}', [SizeControll::class, 'update']);
    Route::post('size_updatedata/{id}', [SizeControll::class, 'updatedata']);
    Route::get('size_delete/{id}', [SizeControll::class, 'delete']);
    Route::get('status_update_size/{status}/{id}', [SizeControll::class, 'status']);

    Route::get('color', [ColorControll::class, 'index']);
    Route::get('color_add', [ColorControll::class, 'color_add']);
    Route::post('color_insert', [ColorControll::class, 'insert'])->name('color_insert');
    Route::get('color_update/{id}', [ColorControll::class, 'update']);
    Route::post('color_updatedata/{id}', [ColorControll::class, 'updatedata']);
    Route::get('color_delete/{id}', [ColorControll::class, 'delete']);
    Route::get('status_update_color/{status}/{id}', [ColorControll::class, 'status']);

    Route::get('tax', [TaxsController::class, 'index']);
    Route::get('tax_add', [TaxsController::class, 'tax_add']);
    Route::post('tax_insert', [TaxsController::class, 'insert'])->name('tax_insert');
    Route::get('tax_update/{id}', [TaxsController::class, 'update']);
    Route::post('tax_updatedata/{id}', [TaxsController::class, 'updatedata']);
    Route::get('tax_delete/{id}', [TaxsController::class, 'delete']);
    Route::get('status_update_tax/{status}/{id}', [TaxsController::class, 'status']);

    Route::get('product', [ProductController::class, 'index']);
    Route::get('product_add', [ProductController::class, 'product_add']);
    Route::post('product_insert', [ProductController::class, 'insert'])->name('product_insert');
    Route::get('product_update/{id}', [ProductController::class, 'update']);
    Route::post('product_updatedata/{id}', [ProductController::class, 'updatedata']);
    Route::get('product_delete/{id}', [ProductController::class, 'delete']);
    Route::get('status_update_product/{status}/{id}', [ProductController::class, 'status']);
    Route::get('product_attr_delete/{pattr}/{pid}', [ProductController::class, 'deleteattr']);
    Route::get('product_image_delete/{piid}/{pid}', [ProductController::class, 'deleteimg']);

    Route::get('brand', [BrandController::class, 'index']);
    Route::get('brand_add', [BrandController::class, 'brand_add']);
    Route::post('brand_insert', [BrandController::class, 'insert'])->name('brand_insert');
    Route::get('brand_update/{id}', [BrandController::class, 'update']);
    Route::post('brand_updatedata/{id}', [BrandController::class, 'updatedata']);
    Route::get('brand_delete/{id}', [BrandController::class, 'delete']);
    Route::get('status_update_brand/{status}/{brand_id}', [BrandController::class, 'status']);

    Route::get('customer', [CustomerController::class, 'index']);
    Route::get('status_update_customer/{status}/{customer_id}', [CustomerController::class, 'status']);
    Route::get('customer_show/{customer_id}', [CustomerController::class, 'show']);

    Route::get('homeBanner', [HomeBannerController::class, 'index']);
    Route::get('homeBanner_add', [HomeBannerController::class, 'homeBanner_add']);
    Route::post('homeBanner_insert', [HomeBannerController::class, 'insert'])->name('homeBanner_insert');
    Route::get('homeBanner_update/{id}', [HomeBannerController::class, 'update']);
    Route::post('homeBanner_updatedata/{id}', [HomeBannerController::class, 'updatedata']);
    Route::get('homeBanner_delete/{id}', [HomeBannerController::class, 'delete']);
    Route::get('status_update_homeBanner/{status}/{homeBanner_id}', [HomeBannerController::class, 'status']);

    Route::get('order', [OrderController::class, 'index']);
    Route::get('admin_login/order_detail/{id}', [OrderController::class, 'order_detail']);
    Route::post('admin_login/order_detail/{id}', [OrderController::class, 'track_update']);
    Route::get('admin_login/payment_status_update/{statu}/{id}', [OrderController::class, 'payment_status_update']);
    Route::get('admin_login/order_status_update/{statu}/{id}', [OrderController::class, 'order_status_update']);


    Route::get('product_review', [ProductReviews::class, 'index']);
    Route::get('product_review_update/{status}/{id}', [ProductReviews::class, 'product_review_update']);



    
});

//Admin Route Set End 


//From End Route Set Start

Route::get('/',[FrontController::class, 'index']);
Route::get('category/{id}',[FrontController::class,'category']);
Route::get('product/{id}',[FrontController::class,'product']);
Route::post('add_to_cart',[FrontController::class,'add_to_cart']);
Route::get('cart',[FrontController::class,'cart']);
Route::get('search/{str}',[FrontController::class,'search']);
Route::get('registration',[FrontController::class,'registration']);
Route::post('registration_process',[FrontController::class,'registration_process']);
Route::post('login_process',[FrontController::class,'login_process']);
Route::get('/user_logout', function(){
    session()->forget('FRONT_USER_LOGIN');
    session()->forget('FRONT_USER_NAME');
    session()->forget('FRONT_USER_ID');
    session()->forget('USER_TEMP_ID');
    return redirect('/');
} );
Route::get('verification/{id}',[FrontController::class,'email_verification']);
Route::post('forgot_password',[FrontController::class,'forgot_password']);
Route::get('forgot_password_change/{id}',[FrontController::class,'forgot_password_change']);
Route::post('forgot_password_process',[FrontController::class,'forgot_password_process']);


Route::get('checkout',[FrontController::class,'checkout']);
Route::post('apply_coupon_code',[FrontController::class,'apply_coupon_code']);
Route::post('remove_coupon_code',[FrontController::class,'remove_coupon_code']);
Route::post('place_order_detail',[FrontController::class,'place_order_detail']);
Route::get('order_place',[FrontController::class,'order_place']);
Route::get('instamojo_submit',[FrontController::class,'instamojo_submit']);
Route::get('order_fail',[FrontController::class,'order_fail']);


Route::group(['middleware'=>'user_auth'], function(){
    Route::get('/my_order',[FrontController::class,'my_order']);
Route::get('order_detail/{id}',[FrontController::class,'order_detail']);
Route::post('product_review',[FrontController::class,'product_review']);
});
//From End Route Set End
