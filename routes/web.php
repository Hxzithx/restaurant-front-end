<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeMenuController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use League\OAuth2\Client\Provider\Google;

Route::get('/', function() {
    return redirect()->route('login');
});

// Public routes
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('callback');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Route::get('/clear-session', function() {
//     session()->flush();
//     return 'Session cleared! <a href="/login">Go to login</a>';
// });
// Protected routes
Route::middleware('api.auth')->group(function() {

    Route::get('/home', function () {
        return view('homepages.homepage-2');
    })->name('home');

    // Route::get('/home-menu', [HomeMenuController::class, 'index'])->name('home-menu');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/menu/{id}', [MenuController::class, 'show'])->name('menu.show');

    Route::get('/about', function() {
        return view('other_pages.page-about');
    })->name('about');

    Route::get('/chefs', function() {
        return view('other_pages.page-chefs');
    })->name('chefs');

    Route::get('/contact-us', function() {
        return view('other_pages.elements-contact-form');
    })->name('contact');

    Route::get('/faq', function() {
        return view('other_pages.page-faqs');
    })->name('faq');

    Route::get('/guest-book', function() {
        return view('other_pages.page-guestbook');
    })->name('guestbook');

    Route::get('/reservation', function() {
        return view('other_pages.page-reservation');
    })->name('reservation');

    Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
    
    Route::get('/shopping-cart', function() {
        return view('other_pages.shop-cart');
    })->name('cart');

    Route::get('/blog', function() {
         return view('other_pages.blog-standard-centered');
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/customer/profile/check', [ProfileController::class, 'checkProfile']);

    Route::get('/order-summary', function() {
         return view('orderSummary.summary');
    })->name('order-summary');

    // Route::get('/order-payment', function(){
    //    return view('orderPayment.orderPayment');  
    // })->name('order-payment');
});
