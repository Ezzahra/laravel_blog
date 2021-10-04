<?php

use App\Http\Controllers\Auth\RoleVerificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostOfPublisherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


//Route::get('/home',[PostController::class, 'index'])->name('blog.posts');

Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/verify-role', [RoleVerificationController::class, 'index'])->name('roleVerification');

Route::resource('/blog', PostController::class);
Route::resource('/category', CategoryController::class);
Route::get('/users/block/{id}', [ UserController::class, 'block' ])->name('blockUser');
Route::get('/users/unblock/{id}', [ UserController::class, 'unblock' ])->name('unblockUser');
Route::get('/users', [ UserController::class, 'index' ])->name('userIndex');
Route::resource('/posts', PostOfPublisherController::class);
Route::get('/', [ HomeController::class, 'index' ]);
