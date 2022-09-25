<?php

use App\Http\Controllers\Buy_product;
use App\Http\Controllers\catagori;
use App\Http\Controllers\Faq_controller;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\HqcvvController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Login;
use App\Http\Controllers\News_controller;
use App\Http\Controllers\Order_controller;
use App\Http\Controllers\Productview;
use App\Http\Controllers\Profile;
use App\Http\Controllers\Support_controller;
use App\monero\mymonero;

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
Route::get('/', function () {return redirect('home');})->middleware('user_cheak');

Route::get('/login', function () { return view('login');})->middleware('user_cheak');

Route::post('/login', [Login::class, 'log_in'])->middleware('user_cheak');

Route::get("/twofactorcheak",[Login::class, 'twofactor'])->middleware(['twofactor','only_log']);

Route::post("/verify2fa",[Login::class, 'verify'])->middleware(['twofactor','only_log']);

Route::get('/register', function () { return view('register');})->middleware('user_cheak');

Route::post('/register', [Login::class, 'register'])->middleware('user_cheak');

Route::get('/memmonic', [Login::class, 'show_key'])->middleware('user_cheak');

Route::post('/registerkey', [Login::class, 'register_key'])->middleware('user_cheak');

Route::get('/forgot_password', [Login::class, 'show_forgot'])->middleware('user_cheak');

Route::post('/forgot_password', [Login::class, 'forgot_cheak'])->middleware('user_cheak');

Route::get('/set_new_password', [Login::class, 'set_password'])->middleware('user_cheak');

Route::post('/set_password', [Login::class, 'new_password'])->middleware('user_cheak');

Route::get('/home', [Homecontroller::class, 'show_home'])->middleware(['user_cheak','update_order']);

Route::get('/catagoriview/{cat}', [catagori::class, 'showcat'])->middleware('user_cheak');

Route::get('/productview/{id}', [Productview::class, 'showproduct'])->middleware(['user_cheak','update_order']);

Route::post('/buynow', [Buy_product::class, 'payout'])->middleware(['user_cheak','only_log']);

Route::get('/payout/{id}', [Buy_product::class, 'show_payout'])->middleware(['user_cheak','only_log']);

Route::post('/confirm_order', [Buy_product::class, 'confirm'])->middleware(['user_cheak','only_log']);

Route::get('/news', [News_controller::class, 'show_news'])->middleware(['user_cheak','update_order']);

Route::get('/supports', [Support_controller::class, 'show_support'])->middleware(['user_cheak','only_log']);

Route::post('/createsupport', [Support_controller::class, 'create'])->middleware(['user_cheak','only_log']);

Route::get('/showorder/{id}', [Order_controller::class, 'show_details'])->middleware(['user_cheak','update_order','only_log']);

Route::get('markdeliver/{id}', [Order_controller::class, 'markdeliver'])->middleware(['user_cheak','update_order','only_log']);

Route::get('/review/{id}', [Order_controller::class, 'show_review'])->middleware(['user_cheak','only_log']);

Route::post('/rateproduct/{id}', [Order_controller::class, 'post_review'])->middleware(['user_cheak','only_log']);

Route::get('/faq', [Faq_controller::class, 'show_faq'])->middleware('user_cheak');

Route::get('/orders', [Order_controller::class, 'show_order'])->middleware(['user_cheak','only_log','update_order']);

Route::get('/profile', [Profile::class, 'show'])->middleware(['user_cheak','only_log']);


Route::get('/setpgp', [Profile::class, 'setpgp'])->middleware(['user_cheak','only_log']);

Route::post('/setnewpgp', [Profile::class, 'setnewpgp'])->middleware(['user_cheak','only_log']);

Route::get('/verify', [Profile::class, 'verify'])->middleware(['user_cheak','only_log']);

Route::post('/verifypgp', [Profile::class, 'verifypgp'])->middleware(['user_cheak','only_log']);

Route::post('/twofactor', [Profile::class, 'twofactor'])->middleware(['user_cheak','only_log']);

Route::get('/pgp', [Homecontroller::class, 'showpgp'])->middleware('user_cheak');

Route::get('/logout', [Login::class , 'logout']);

Route::get('/chat/{id}', [Order_controller::class, 'showchat'])->middleware(['user_cheak','only_log']);

Route::post('/postmsg/{id}', [Order_controller::class, 'postmsg'])->middleware(['user_cheak','only_log']);

Route::get('/monero', function(){
    $a = new mymonero();
    $a = $a->refresh();

});
