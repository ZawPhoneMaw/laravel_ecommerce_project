<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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

route::get('/', function(){
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

route::get('/redirect', [HomeController::class , 'redirect']);
route::post('/addtocart/{id}', [HomeController::class, 'addtocart']);
route::get('/cartdetails', [HomeController::class , 'cartdetails']);
route::post('/userinfoupdate', [HomeController::class, 'userinfoupdate']);
route::get('/cart_delete/{id}', [HomeController::class, 'cart_delete']);
route::post('/orderconfirm', [HomeController::class, 'orderconfirm']);
route::get('/userorders', [HomeController::class , 'userorders']);
route::get('/detailstatus/{id}',[HomeController::class, 'detailstatus']);


route::post('/add_product', [AdminController::class, 'add_product']);
route::get('/product_add', [AdminController::class , 'product_add']);
route::get('/product_details',[AdminController::class, 'product_details']);
route::get('/product_delete/{id}',[AdminController::class, 'product_delete']);
route::get('/user_details',[AdminController::class, 'user_details']);
route::get('/user_delete/{id}',[AdminController::class, 'user_delete']);
route::get('/product_update/{id}',[AdminController::class, 'product_update']);
route::post('/update_product/{id}', [AdminController::class, 'update_product']);
route::get('/order_details',[AdminController::class, 'order_details']);
route::get('/details/{id}',[AdminController::class, 'details']);
route::get('/confirmorderstatus/{id}',[AdminController::class, 'confirmorderstatus']);