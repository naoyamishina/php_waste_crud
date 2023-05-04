<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NiceController;
use App\Http\Controllers\Controller;

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

Route::get('/', function () {
    return view('welcome');
})->name('top');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('post/mypost', [PostController::class, 'mypost'])->name('post.mypost')->middleware('auth');
Route::post('/nice', [PostController::class, 'nice'])->name('post.nice')->middleware('auth');
Route::get('/post/nices', [PostController::class, 'nice_posts'])->name('post.nice_posts')->middleware('auth');
Route::get('/post/ranking', [PostController::class, 'ranking'])->name('post.ranking')->middleware('auth');
Route::resource('post', PostController::class)->middleware('auth');

Route::post('post/comment/store', [CommentController::class, 'store'])->name('comment.store')->middleware('auth');

require __DIR__.'/auth.php';
