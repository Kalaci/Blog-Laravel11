<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\ClearanceLevelMiddleware;
use App\Http\Controllers\ModeratorController;
use App\Models\Post;


Route::get('/',  function () {
    $posts = Post::latest()->get();  
    return view('welcome', compact('posts'));
});

Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profileView/{id}', [ProfileController::class, 'profileView'])->name('profileView');
});


require __DIR__.'/auth.php';

Route::get('/addPost', [PostController::class, 'createView'])->name('postInfo');
Route::post('/addPost/submit', [PostController::class, 'add'])->name('postSubmit');
Route::get('/userPosts', [PostController::class, 'userPosts'])->middleware('auth')->name('userPosts');
Route::get('/post/{post}', [PostController::class, 'showPost'])->middleware('auth')->name('showPost');
Route::get('post/delete/{id}', [PostController::class, 'deletePost'])->middleware('auth');
Route::get('post/edit/{id}', [PostController::class, 'editPost'])->middleware('auth');
Route::post('post/update/{id}', [PostController::class, 'updatePost'])->middleware('auth')->name('postUpdate');


Route::get('/admin/dashboard', [AdminController::class, 'dashboardView'])->middleware('clearance')->name('adminDashboard');
Route::get('/admin/user/delete/{id}', [AdminController::class, 'deleteUser'])->middleware('clearance'); 
Route::get('/admin/post/delete/{id}', [AdminController::class, 'deletePost'])->middleware('clearance'); 
Route::get('/admin/add/user', [AdminController::class, 'viewAddUser'])->middleware('clearance')->name('viewAddUser');
Route::post('/admin/add/user/submit', [AdminController::class, 'addUser'])->middleware('clearance')->name('adminAddUserSubmit');

Route::middleware('clearance')->group(function () {
    Route::get('/moderator/dashboard', [ModeratorController::class, 'dashboard'])->name('moderator.dashboard');
    Route::get('/moderator/post/delete/{id}', [ModeratorController::class, 'deletePost'])->name('post.delete');
    Route::get('/moderator/user/delete/{id}', [ModeratorController::class, 'deleteUser'])->name('moderator.deleteUser');
});