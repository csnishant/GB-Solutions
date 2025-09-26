<?php
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// Login/Register
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Customer Home
Route::get('/customer/home', [HomeController::class, 'index'])->name('customer.home');


//admin routes
// Admin routes
Route::middleware(['auth'])->group(function() {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Category
    Route::post('/admin/category/store', [AdminController::class, 'storeCategory'])->name('admin.category.store');

    // Product
    Route::post('/admin/product/store', [AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit']);
    Route::put('/product/update/{id}', [ProductController::class, 'update']);
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy']);
});


Route::get('/', [CategoryController::class, 'index']);

Route::get('/category/{id}', [ProductController::class, 'byCategory']);
Route::get('/product/{id}', [ProductController::class, 'show']);

// Show product upload form
Route::get('/product/create', [ProductController::class, 'create']);

// Store product in database
Route::post('/product/store', [ProductController::class, 'store']);