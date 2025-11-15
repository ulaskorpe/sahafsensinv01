<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
 
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteDataController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

Route::get('/remember-me',[AuthController::class, 'remember_me'])->name('remember-me');
Route::post('/login-post',[AuthController::class,'login_post'])->name('admin-login-post');
Route::get('/admin-login',[AuthController::class,'login'])->name('admin-login');
 

Route::group(['prefix'=>'admin-panel','middleware'=>\App\Http\Middleware\checkAdmin::class],function (){

    Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile',[AdminController::class, 'profile'])->name('profile');
    Route::get('/notifications',[AdminController::class, 'notifications'])->name('notifications');
    Route::get('/admin-settings',[AdminController::class, 'admin_settings'])->name('admin-settings');
    Route::get('/check-email/{email}',[AdminController::class, 'check_email'])->name('check-email');
    Route::get('/check-old-pw/{pw}',[AdminController::class, 'check_old_pw'])->name('check-old-pw');
    
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    Route::post('/profile-post',[AdminController::class,'profile_post'])->name('profile-post');
    Route::post('/password-post',[AdminController::class,'password_post'])->name('password-post');


 
     //Route::resource('blogs', CategoryController::class);
    Route::group(['prefix'=>'categories'],function(){


    Route::get('/{type?}',[CategoryController::class,'index'])->name('categories.index');
    Route::get('/create/{type?}',[CategoryController::class,'create'])->name('categories.create');
    Route::get('/edit/{slug}',[CategoryController::class,'edit'])->name('categories.edit');
    Route::post('/update',[CategoryController::class,'update'])->name('category-update');
    Route::post('/store',[CategoryController::class,'store'])->name('categories.store');
    Route::post('/delete',[CategoryController::class,'destroy'])->name('category-delete');
    Route::get('/check-slug/{slug}/{type?}/{id?}',[CategoryController::class, 'check_slug'])->name('check-slug');
    Route::get('/select-categories/{cat_id}/{type?}/{show?}',[CategoryController::class,'select_categories'])->name('select-categories');
    Route::get('/show-up-categories/{cat_id}',[CategoryController::class, 'show_up_categories'])->name('show-up-categories');
    Route::get('/show-sub-categories/{cat_id}/{type?}',[CategoryController::class, 'show_sub_categories'])->name('show-sub-categories');
    Route::get('/show-category-images/{cat_id}/{image_id?}/{rank?}',[CategoryController::class, 'show_category_images'])->name('show-category-images');
    Route::get('/delete-category-image/{image_id}',[CategoryController::class, 'delete_category_image'])->name('delete-category-images');
    Route::get('/show-image/{type}/{id}',[CategoryController::class,'show_image'])->name('show-image');
   //Route::get('/categories-div/{cat_id}',[CategoryController::class,'categories_div'])->name('categories-div');
 
        });

 
        //Route::resource('blogs', BlogController::class);
        Route::group(['prefix'=>'blogs'],function(){
            Route::get('/',[BlogController::class,'index'])->name('blogs.index');
            Route::get('/check-slug/{slug}/{type?}/{id?}',[BlogController::class, 'check_slug'])->name('check-slug');
            Route::get('/create/{type?}',[BlogController::class,'create'])->name('blogs.create');
            Route::post('/store',[BlogController::class,'store'])->name('blogs.store');
            Route::post('/delete',[BlogController::class,'destroy'])->name('blogs-delete');
            Route::get('/edit/{slug}',[BlogController::class,'edit'])->name('blogs.edit');
            Route::post('/update',[BlogController::class,'update'])->name('blogs-update');
            Route::get('/show-image/{type}/{id}',[BlogController::class,'show_image'])->name('show-image');
            Route::get('/show-blog-images/{blog_id}/{image_id?}/{rank?}',[BlogController::class, 'show_blog_images'])->name('show-blog-images');
            Route::get('/delete-blog-image/{image_id}',[BlogController::class, 'delete_blog_image'])->name('delete-blog-images');
        });

        Route::group(['prefix'=>'products'],function(){
            Route::get('/create', [ProductController::class, 'create'])->name('products.create');
            Route::get('/{verified?}', [ProductController::class, 'index'])->name('products.index');
            Route::get('/check-slug/{slug}/{type?}/{id?}',[ProductController::class, 'check_slug'])->name('check-slug');
            Route::get('/show-image/{type}/{id}',[ProductController::class,'show_image'])->name('show-image');
            Route::post('/store',[ProductController::class,'store'])->name('products.store');
            Route::post('/delete',[ProductController::class,'destroy'])->name('products-delete');
            Route::get('/edit/{id}/{tab?}',[ProductController::class,'edit'])->name('products.edit');
            Route::post('/update',[ProductController::class,'update'])->name('products-update');
            Route::post('/update-product-images',[ProductController::class,'update_product_images'])->name('update-product-images');
            Route::get('/show-product-images/{product_id}/{image_id?}/{rank?}',[ProductController::class, 'show_product_images'])->name('show-page-images');
            Route::get('/delete-product-image/{image_id}',[ProductController::class, 'delete_product_image'])->name('delete-product-images');
        });

        Route::group(['prefix'=>'site-data'],function(){
            Route::get('/', [SiteDataController::class, 'index'])->name('site-data.index');
            Route::get('/create', [SiteDataController::class, 'create'])->name('site-data.create');
            Route::get('/check-slug/{slug}/{type?}/{id?}',[SiteDataController::class, 'check_slug'])->name('site-data-check-slug');
            Route::post('/store',[SiteDataController::class,'store'])->name('site-data.store');
            Route::get('/edit/{slug}',[SiteDataController::class,'edit'])->name('site-data.edit');
            Route::post('/update',[SiteDataController::class,'update'])->name('site-data-update');
        });


        Route::group(['prefix'=>'pages'],function(){
            Route::get('/', [PageController::class, 'index'])->name('pages.index');
            Route::get('/create', [PageController::class, 'create'])->name('pages.create');
            Route::get('/check-slug/{slug}/{type?}/{id?}',[PageController::class, 'check_slug'])->name('pages-check-slug');
            Route::post('/store',[PageController::class,'store'])->name('pages.store');
            Route::get('/edit/{slug}',[PageController::class,'edit'])->name('pages.edit');
            Route::post('/update',[PageController::class,'update'])->name('pages-update');
            Route::get('/show-page-images/{page_id}/{image_id?}/{rank?}',[PageController::class, 'show_page_images'])->name('show-page-images');
            Route::get('/delete-page-image/{image_id}',[PageController::class, 'delete_page_image'])->name('delete-page-images');
            Route::post('/delete',[PageController::class,'destroy'])->name('pages-delete');
        });

      
});