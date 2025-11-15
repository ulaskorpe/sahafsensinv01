<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\TypeController as AdminTypeController;


Route::group(['prefix'=>'admin-panel' ],function (){
    Route::get('/remember-me',[AuthController::class, 'remember_me'])->name('remember-me');
    Route::post('/login-post',[AuthController::class,'login_post'])->name('admin-login-post');
    Route::get('/admin-login',[AuthController::class,'login'])->name('admin-login');


    Route::group([ 'middleware'=>['auth','checkAdmin']],function (){

        Route::get('/notifications',[AdminController::class, 'notifications'])->name('notifications');
        Route::get('/comments',[AdminController::class, 'comments'])->name('admin-comments');
        Route::get('/messages',[AdminController::class, 'messages'])->name('admin-messages');
        Route::get('/message-view/{id}',[AdminController::class, 'messageDetail'])->name('admin-messages-detail');
        Route::post('/message-reply',[AdminController::class, 'contactPost'])->name('admin-message-reply');
        Route::get('/messages-delete/{id}',[AdminController::class, 'messageDelete'])->name('admin-messages-delete');
        Route::get('/comment-delete/{id}',[AdminController::class, 'commentDelete'])->name('admin-comment-delete');
        Route::get('/comment-confirm/{id}/{confirm}',[AdminController::class, 'commentConfirm'])->name('admin-comment-confirm');
        Route::get('/admin-settings',[AdminController::class, 'admin_settings'])->name('admin-settings');
        Route::get('/check-email/{email}',[AdminController::class, 'check_email'])->name('check-email');
        Route::get('/check-phone/{phone}',[AdminController::class, 'check_phone'])->name('check-phone');
        Route::get('/check-old-pw/{pw}',[AdminController::class, 'check_old_pw'])->name('check-old-pw');
        Route::group(['prefix'=>'content' ],function (){
            Route::get('/list/{type}/{lang?}/{parent_id?}',[ContentController::class,'list'])->name('content-list');
            Route::get('/create/{type}/{lang?}/{parent_id?}',[ContentController::class,'create'])->name('content-create');
            Route::post('/create',[ContentController::class,'createPost'])->name('content-create-post');
            Route::get('/count-select/{cat_id}/{type}/{post_id?}',[ContentController::class,'countSelect'])->name('count-select');

            Route::get('/update/{id}',[ContentController::class,'update'])->name('content-update');
            Route::post('/update',[ContentController::class,'updatePost'])->name('content-update-post');

            Route::get('/delete/{id}',[ContentController::class,'deletePost'])->name('content-delete');
            Route::post('/copy_others',[ContentController::class,'copyOthers'])->name('content-copy-others');
            Route::post('/bring-count/{parent_id}/{post_id?}',[ContentController::class,'bringCount'])->name('bring-count');
            Route::get('/change_lang/{id}/{lang}',[ContentController::class,'changeLang'])->name('change-lang');
            Route::get('/empty_field/{id}/{field}',[ContentController::class,'emptyField'])->name('emptyField-content');

        });

        Route::get('/profile',[AdminController::class, 'profile'])->name('profile');
        Route::get('/settings',[AdminController::class, 'settings'])->name('settings');
        Route::post('/profile',[AdminController::class, 'profile_post'])->name('profile-post');
        Route::post('/settings',[AdminController::class, 'settings_post'])->name('settings-post');
        Route::post('/password-post',[AdminController::class, 'password_post'])->name('password-post');
        Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
     //   Route::get('/test-1',[DashboardController::class, 'test1'])->name('test1');
        Route::post('/logout',[AuthController::class,'logout'])->name('logout');


        Route:: group([
           'middleware' => ['checkSudo'],
            'prefix' => 'sudo',
            'as' => 'sudo.'
        ],function (){
                Route::resource('types', AdminTypeController::class)->except(['show']);
        });

        Route:: group([
            'middleware' => ['checkSudo'],
             'prefix' => 'admins',
             'as' => 'sudo.'
         ],function (){
            Route::get('/list',[AdminController::class, 'adminList'])->name('admin-list');
            Route::get('/admin-create',[AdminController::class, 'adminCreate'])->name('admin-create');
            Route::post('/admin-post',[AdminController::class, 'adminPost'])->name('admin-post');
         });
 
    });
});
