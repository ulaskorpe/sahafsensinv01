<?php

use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\UserAddressController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
//use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

Route::middleware(['frontenddata'])->group(function () {
    Route::get('/',[HomeController::class, 'index'])->name('index');
    Route::get('/blog/{slug}/{id}',[HomeController::class, 'blog_detail']);
    Route::get('/giris',[UserController::class, 'login'])->name('user-login');
    Route::get('/sifremi-unuttum',[UserController::class, 'forget_password'])->name('user-forget-pw');
    
    
    Route::get('/kayit-ol',[UserController::class, 'register'])->name('user-register');
    Route::get('/all-blog/{key?}/{page?}',[HomeController::class, 'blogs']);

    Route::get('/kategori-detay/{slug}',[HomeController::class, 'category_detail'])->name('category_detail') ;
    Route::get('/confirm/{token}',[UserController::class, 'confirm_user'])->name('confirm_user');
    Route::get('/eposta-guncelleme/{token}',[UserController::class, 'email_update'])->name('email_update');
    Route::get('/urun-detay/{slug}/{id}',[ProductController::class, 'product_detail'])->name('product_detail');
    Route::get('/blog-detay/{slug}/{id}',[BlogController::class, 'blog_detail'])->name('blog_detail');
    Route::get('/sss',[HomeController::class, 'faqs'])->name('sss');

    Route::get('/hakkimizda',[HomeController::class, 'about'])->name('about-us');
    Route::get('/yardim',[HomeController::class, 'help'])->name('help-me');
    
    Route::get('/iletisim',[ContactController::class, 'contact'])->name('contact');

    Route::group(['middleware'=>\App\Http\Middleware\checkUser::class],function (){
        Route::post('/make-offer',[ProductController::class, 'make_offer'])->name('make_offer');
        Route::get('/hesabim/{select?}',[UserController::class, 'user_profile'])->name('user-profile');
      

    });
});

Route::group(['middleware'=>\App\Http\Middleware\checkUser::class],function (){

    Route::post('/comment-post',[ProductController::class, 'comment_post'])->name('comment_post');
    Route::post('/user-address-post',[UserAddressController::class, 'user_address_post'])->name('user-address-post');
    Route::post('/user-profile-post',[UserController::class, 'user_profile_post'])->name('user-profile-post');
    Route::get('/cancel-email-update',[UserController::class, 'cancel_email_update'])->name('cancel-email-update');
    Route::get('/address-form/{id?}',[UserAddressController::class, 'address_form'])->name('address-form');
    Route::get('/make-primary/{id}',[UserAddressController::class, 'make_primary'])->name('make-primary');
    Route::get('/delete-address/{id}',[UserAddressController::class, 'delete_address'])->name('delete-address');
    Route::get('/user-addresses',[UserAddressController::class, 'user_addresses'])->name('user-addresses');
    Route::get('/town-select/{city_id}',[UserAddressController::class, 'town_select'])->name('town-select');
    Route::get('/district-select/{town_id}',[UserAddressController::class, 'district_select'])->name('district-select');
    Route::get('/neighborhood-select/{district_id}',[UserAddressController::class, 'neighborhood_select'])->name('neighborhood-select');
});




Route::post('/iletisim-post',[ContactController::class, 'contact_post'])->name('contact_post');


Route::get('/faqin/{key?}',[HomeController::class, 'faqin'])->name('faqin');
Route::get('/product-bids/{product_id}/{page?}',[ProductController::class, 'product_bids'])->name('product-bids');
Route::get('/product-comments/{product_id}/{page?}',[ProductController::class, 'product_comments'])->name('product-comments');
Route::get('/product-make-comment/{product_id}/{comment_id?}',[ProductController::class, 'product_make_comment'])->name('product-make-comment');

Route::get('/check-email/{email}',[UserController::class, 'email_check'])->name('email-user-check');
Route::get('/check-username/{username}',[UserController::class, 'username_check'])->name('username-check');
Route::get('/check-phone/{phone_number}',[UserController::class, 'phone_check'])->name('phone-check');
Route::post('/register_user',[UserController::class, 'register_user'])->name('register_user');
Route::post('/login_user',[UserController::class, 'login_user'])->name('login_user');
Route::post('/logout_user',[UserController::class, 'logout'])->name('logout_user');
Route::post('/forget-pw-post',[UserController::class, 'forget_pw_post'])->name('forget_pw_post');
Route::get('/fetch-page/{page_id}',[HomeController::class, 'fetch_page'])->name('fetch-page');
