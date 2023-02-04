<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\Admin\CategoryControll;
use App\Http\Controllers\Admin\CouponControll;
use App\Http\Controllers\Admin\SizeControll;
use App\Http\Controllers\Admin\ColorControll;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\TaxsController;
use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;

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



Route::get('/',[FrontController::class, 'index']);


Route::get('/admin',[AdminController::class, 'index'])->name('admin');
Route::post('/admin/auth',[AdminController::class, 'auth'])->name('admin.auth');
Route::get('/admin/reg',[AdminController::class, 'register'])->name('admin.reg');
Route::post('/admin/reg',[AdminController::class, 'store'])->name('admin.reg');




Route::group(['middleware'=>'admin_auth'], function(){
    // Route::get('/', function () {
    //     return view('welcome');
    // });

    Route::get('/index', function(){
        return view('admin_login/index');
    });
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
});

