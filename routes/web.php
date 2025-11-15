<?php



use Illuminate\Support\Facades\Route;

//use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('admin/index');
// });



Route::get('/category/{slug}',[HomeController::class, 'category'])->name('category-page');

//Route::get('/admin-panel',[DashboardController::class, 'index'])->name('admin-index');
//Route::post('/register',[AuthController::class,'register'])->name('register');

Route::post('/test',[HomeController::class,'login_post'])->name('test');

require __DIR__ . '/admin_panel.php';
require __DIR__ . '/user_panel.php';