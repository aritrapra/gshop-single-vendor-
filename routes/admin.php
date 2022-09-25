<?php

use App\Http\Controllers\admin\admin_order;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\Login;
use App\Http\Controllers\admin\Products;
use App\Http\Controllers\admin\Catagories;
use App\Http\Controllers\admin\faq_controller;
use App\Http\Controllers\admin\News_controller;

use App\Http\Controllers\admin\Support_controller;
use App\Http\Controllers\admin\pgp_controller;
use App\Http\Controllers\admin\dashboard;
use App\Models\Order;

Route::get('/', function () {
    return redirect('/godisHusetmyadmin/login');
});
######
Route::get('/login', [Login::class , 'getdata']);
####

####
Route::post('/adminlogin', [Login::class , 'login']);



Route::get('/catagori', [Catagories::class, 'getdata'])
    ->middleware('adminsecure');

Route::post('/catagori/add', [Catagories::class, 'addcat'])
    ->middleware('adminsecure');

Route::get('/catagori/remove/{cat}', [Catagories::class, 'deletemaincat'])
    ->middleware('adminsecure');

Route::get('/product/add', [Products::class, "add"])
    ->middleware('adminsecure');

Route::get('/product/add1/{id}', [Products::class, "add1"])
    ->middleware('adminsecure');

Route::get('/product/clone/{id}', [Products::class, "clone"])
    ->middleware('adminsecure');

Route::post('/product/add1/{id}', [Products::class, 'post_add1'])
    ->middleware('adminsecure');

Route::get('/product/add2/{id}', [Products::class, "add2"])
    ->middleware('adminsecure');

Route::post('/product/add2/{id}', [Products::class, 'post_add2'])
    ->middleware('adminsecure');

Route::get('/product/remove1/{id}/{sel}', [Products::class, "remove1"])
    ->middleware('adminsecure');

Route::get('/product/add3/{id}', [Products::class, "add3"])
    ->middleware('adminsecure');

Route::post('/product/add3/{id}', [Products::class, 'post_add3'])
    ->middleware('adminsecure');

Route::get('/product/remove2/{id}/{sel}', [Products::class, "remove2"])
    ->middleware('adminsecure');

Route::get('/product/finish/{id}', [Products::class, "finish"])
    ->middleware('adminsecure');

Route::get('/product/pause/{id}', [Products::class, "pause"])
    ->middleware('adminsecure');

Route::get('/products/{id?}', [Products::class, "show_products"])
    ->middleware('adminsecure');

Route::get('/reviews/{id}', [Products::class, "reviews"])
    ->middleware('adminsecure');

Route::get('/removereview/{id}', [Products::class, "remove_review"])
    ->middleware('adminsecure');

Route::get('/product/delete/{id}/{page}', [Products::class, "delete"])
    ->middleware('adminsecure');

Route::get('/news', [News_controller::class , 'show_news'])->middleware('adminsecure');

Route::post('/news/add', [News_controller::class, 'add_news'])
    ->middleware('adminsecure');

Route::get('/news/remove/{id}', [News_controller::class, "delete"])
    ->middleware('adminsecure');


Route::get('/faq', [faq_controller::class , 'fq'])->middleware('adminsecure');

Route::post('/faq/add', [faq_controller::class, 'add_faq'])
    ->middleware('adminsecure');

Route::get('/faq/remove/{id}', [faq_controller::class, "delete"])
    ->middleware('adminsecure');

Route::get('/supports', [Support_controller::class , 'show_support'])->middleware('adminsecure');

Route::get('/orders', [admin_order::class , 'getdata'])->middleware('adminsecure');

Route::get('/order_details/{id}', [admin_order::class , 'orderdetail'])->middleware('adminsecure');

Route::get('/orders/{id}', [admin_order::class , 'action'])->middleware('adminsecure');

Route::get('/failed/{id?}', [admin_order::class , 'failed'])->middleware('adminsecure');

Route::post('/orders/ship/{id}', [admin_order::class , 'ship'])->middleware('adminsecure');

Route::get('/pgp', [pgp_controller::class , 'show'])->middleware('adminsecure');

Route::get('/dashboard', [dashboard::class , 'show'])->middleware('adminsecure');

Route::post('/update_pgp', [pgp_controller::class , 'update'])->middleware('adminsecure');

Route::post('/updateadd', [dashboard::class , 'updateadd'])->middleware('adminsecure');

Route::get('/chat/{id}', [admin_order::class , 'chat'])->middleware('adminsecure');

Route::post('/postmsg/{id}', [admin_order::class, 'postmsg'])->middleware('adminsecure');

Route::get('/alladd' , function(){
    $allod = Order::get('address');
    foreach ($allod as $od) {
        echo $od->address.' ';
    }
})->middleware('adminsecure');


?>
