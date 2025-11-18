<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordResetCodeController;

// =====================
// PUBLIC ROUTES
// =====================
Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/home', [UserController::class, 'index'])->name('home');

// Find a table
Route::post('/findatable', [UserController::class, 'findATable'])->name('book.table');

// =====================
// AUTHENTICATED USER ROUTES
// =====================
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard
    Route::get('/dashboard', [UserController::class, 'home'])->name('dashboard');

    // Cart operations
    Route::post('/addtocart', [UserController::class, 'addToCart'])->name('addtocart');
    Route::post('/addtocart1', [UserController::class, 'addToCart1'])->name('addtocart1');

    Route::get('/foodcart', [UserController::class, 'foodCart'])->name('food.cart');
    Route::get('/drinkcart', [UserController::class, 'drinkCart'])->name('drink.cart');

    // FIXED: These should be DELETE routes, not GET with {id}
    Route::get('/delete_cart/{id}', [UserController::class, 'removeCart'])->name('delete.cart');
    Route::get('/delete_cart1/{id}', [UserController::class, 'removeCart1'])->name('delete.cart1');

    // FIXED: Added the confirm order routes
    Route::post('/confirm_cart', [UserController::class, 'confirmOrderCart'])->name('cart.confirm');
    Route::post('/confirm_cart1', [UserController::class, 'confirmOrderCart1'])->name('cart.confirm1');

    // FIXED: Route names should match what's used in your UserController
    Route::get('/order_status', [UserController::class, 'orderStatus'])->name('order_status');
    Route::get('/order_status1', [UserController::class, 'orderStatus1'])->name('order_status1');
});

// =====================
// ADMIN ROUTES
// =====================
Route::middleware(['auth', 'admin'])->group(function () {

    // Add food/drink
    Route::get('/addfood', [AdminController::class, 'addFood'])->name('admin.addfood');
    Route::post('/addfood', [AdminController::class, 'postAddfood'])->name('admin.postaddfood');

    Route::get('/adddrink', [AdminController::class, 'addDrink'])->name('admin.adddrink');
    Route::post('/adddrink', [AdminController::class, 'postAdddrink'])->name('admin.postadddrink');

    // Show food/drink
    Route::get('/showfood', [AdminController::class, 'showFood'])->name('admin.showfood');
    Route::get('/showdrink', [AdminController::class, 'showDrink'])->name('admin.showdrink');

    // Delete food/drink
    Route::get('/deletefood/{id}', [AdminController::class, 'deleteFood'])->name('admin.deletefood');
    Route::get('/deletedrink/{id}', [AdminController::class, 'deleteDrink'])->name('admin.deletedrink');

    // Update food/drink
    Route::get('/updatefood/{id}', [AdminController::class, 'updateFood'])->name('admin.updatefood');
    Route::post('/updatefood/{id}', [AdminController::class, 'postUpdatefood'])->name('admin.postupdatefood');

    Route::get('/updatedrink/{id}', [AdminController::class, 'updateDrink'])->name('admin.updatedrink');
    Route::post('/updatedrink/{id}', [AdminController::class, 'postUpdatedrink'])->name('admin.postupdatedrink');

    // Orders
    Route::get('/vieworder', [AdminController::class, 'viewOrders'])->name('admin.vieworders');
    Route::get('/vieworders', [AdminController::class, 'viewOrderss'])->name('admin.vieworderss');

    Route::get('/delivered/{id}', [AdminController::class, 'foodStatusDelivered'])->name('admin.delivered');
    Route::get('/delivered1/{id}', [AdminController::class, 'drinkStatusDelivered'])->name('admin.delivered1');

    Route::get('/cancel/{id}', [AdminController::class, 'foodStatusCancel'])->name('admin.cancel');
    Route::get('/cancel1/{id}', [AdminController::class, 'drinkStatusCancel'])->name('admin.cancel1');

    // Booked tables
    Route::get('/view_booked_table', [AdminController::class, 'viewBookedTable'])->name('admin.viewbookedtable');
});

// =====================
// PASSWORD RESET CODE ROUTES (CUSTOM EMAIL CODE SYSTEM)
// =====================

// Show email input form
Route::get('/forgot-password-code', [PasswordResetCodeController::class, 'requestCode'])
    ->middleware('guest')
    ->name('password.request-code');

// Send verification code to email
Route::post('/forgot-password-code', [PasswordResetCodeController::class, 'sendCode'])
    ->middleware('guest')
    ->name('password.send-code');

// Show code + new password form
Route::get('/reset-password-code', [PasswordResetCodeController::class, 'showVerifyCodeForm'])
    ->middleware('guest')
    ->name('password.verify-code-form');

// Handle code verification and password reset
Route::post('/reset-password-code', [PasswordResetCodeController::class, 'resetWithCode'])
    ->middleware('guest')
    ->name('password.reset-with-code');