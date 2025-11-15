<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
Route::get('/',[UserController::class,'index']);

Route::post('/findatable',[UserController::class,'findATable'])->name('book.table');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',[UserController::class,'home'])->name('dashboard');
    Route::post('/addtocart',[UserController::class,'addToCart'])->name('addtocart');
    Route::post('/addtocart1',[UserController::class,'addToCart1'])->name('addtocart1');

    Route::get('/foodcart',[UserController::class,'foodCart'])->name('food.cart');
    Route::get('/drinkcart',[UserController::class,'drinkCart'])->name('drink.cart');

    Route::get('/foodcart/{id}',[UserController::class,'removeCart'])->name('delete.cart');
    Route::get('/drinkcart/{id}',[UserController::class,'removeCart1'])->name('delete.cart1');

    Route::post('/confirm_order',[UserController::class,'confirmOrderCart'])->name('cart.confirm');
    Route::post('/confirm_order1',[UserController::class,'confirmOrderCart1'])->name('cart.confirm1');

    Route::get('/order_status',[UserController::class,'orderStatus'])->name('order_status');
    Route::get('/order_status1',[UserController::class,'orderStatus1'])->name('order_status1');
});

Route::get('/addfood',[AdminController::class,'addFood'])->middleware('auth','admin')->name('admin.addfood');
Route::get('/adddrink',[AdminController::class,'addDrink'])->middleware('auth','admin')->name('admin.adddrink');

Route::post('/addfood',[AdminController::class,'postAddfood'])->middleware('auth','admin')->name('admin.postaddfood');
Route::post('/adddrink',[AdminController::class,'postAdddrink'])->middleware('auth','admin')->name('admin.postadddrink');

Route::get('/showfood',[AdminController::class,'showFood'])->middleware('auth','admin')->name('admin.showfood');
Route::get('/showdrink',[AdminController::class,'showDrink'])->middleware('auth','admin')->name('admin.showdrink');

Route::get('/deletefood/{id}',action: [AdminController::class,'deleteFood'])->middleware('auth','admin')->name('admin.deletefood');
Route::get('/deletedrink/{id}',action: [AdminController::class,'deleteDrink'])->middleware('auth','admin')->name('admin.deletedrink');

Route::get('/updatefood/{id}',action: [AdminController::class,'updateFood'])->middleware('auth','admin')->name('admin.updatefood');
Route::get('/updatedrink/{id}',action: [AdminController::class,'updateDrink'])->middleware('auth','admin')->name('admin.updatedrink');

Route::post('/updatefood/{id}',[AdminController::class,'postUpdatefood'])->middleware('auth','admin')->name('admin.postupdatefood');
Route::post('/updatedrink/{id}',[AdminController::class,'postUpdatedrink'])->middleware('auth','admin')->name('admin.postupdatedrink');


Route::get('/vieworder',action: [AdminController::class,'viewOrders'])->middleware('auth','admin')->name('admin.vieworders');
Route::get('/vieworders',action: [AdminController::class,'viewOrderss'])->middleware('auth','admin')->name('admin.vieworderss');

Route::get('/delivered/{id}',[AdminController::class,'foodStatusDelivered'])->middleware('auth','admin')->name('admin.delivered');
Route::get('/delivered1/{id}',[AdminController::class,'drinkStatusDelivered'])->middleware('auth','admin')->name('admin.delivered1');

Route::get('/cancel/{id}',[AdminController::class,'foodStatusCancel'])->middleware('auth','admin')->name('admin.cancel');
Route::get('/cancel1/{id}',[AdminController::class,'drinkStatusCancel'])->middleware('auth','admin')->name('admin.cancel1');

Route::get('/view_booked_table',action: [AdminController::class,'viewBookedTable'])->middleware('auth','admin')->name('admin.viewbookedtable');