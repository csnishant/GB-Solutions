<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResumeController;
use App\Models\Post;

Route::resource('posts', PostController::class);


Route::get('/dashboard', function () {
   $posts=Post::all();//fetch all posts
       return view('dashboard',compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   // Resume Routes
    Route::get('/resume/create', [ResumeController::class, 'create'])->name('resume.create');
    Route::post('/resume/store', [ResumeController::class, 'store'])->name('resume.store');
});

require __DIR__.'/auth.php';
