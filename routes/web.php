<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\BlogController;

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

// Admin Login Routes
Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login');

// Admin Routes with Middleware
Route::middleware('admin.auth')->prefix('admin')->name('admin.')->group(function () {
    // Dashboard and Logout
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('blogs', BlogController::class);

});
Route::get('/blogs', [BlogController::class, 'list'])->name('blogs.index');
Route::get('blog/{id}', [BlogController::class, 'blogDetails'])->name('blog.details');


// Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// Route::post('login', [LoginController::class, 'login']);
// Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route::middleware('auth')->group(function () {
//     Route::get('admin/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
// });
