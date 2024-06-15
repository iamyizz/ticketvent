<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

Route::get('/',[HomeController::class, 'home']);

Route::get('/home',[HomeController::class, 'home'])->middleware(['auth', 'verified'])->name('home');

Route::get('event_detail/{id}', [HomeController::class, 'event_detail'])->middleware(['auth', 'verified']);

Route::post('/order', [HomeController::class, 'store'])->name('order.store');

Route::post('/search', [HomeController::class, 'search'])->name('search');

Route::get('/search-results', [HomeController::class, 'searchResults'])->name('search.results');

Route::get('/category/{categoryName}', [HomeController::class, 'showByCategory'])->name('category.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard', [HomeController::class, 'index'])-> middleware(['auth','admin']);

Route::get('view_category', [AdminController::class, 'view_category'])-> middleware(['auth','admin']);

Route::post('add_category', [AdminController::class, 'add_category'])-> middleware(['auth','admin']);

Route::get('delete_category/{id}', [AdminController::class, 'delete_category'])-> middleware(['auth','admin']);

Route::get('edit_category/{id}', [AdminController::class, 'edit_category'])-> middleware(['auth','admin']);

Route::post('update_category/{id}', [AdminController::class, 'update_category'])-> middleware(['auth','admin']);

Route::post('add_event', [AdminController::class, 'add_event'])-> middleware(['auth','admin']);

Route::post('upload_event', [AdminController::class, 'upload_event'])-> middleware(['auth','admin']);

Route::get('view_event', [AdminController::class, 'view_event'])-> middleware(['auth','admin']);

Route::get('delete_event/{id}', [AdminController::class, 'delete_event'])-> middleware(['auth','admin']);

Route::get('update_event/{id}', [AdminController::class, 'update_event'])-> middleware(['auth','admin']);

Route::post('edit_event/{id}', [AdminController::class, 'edit_event'])-> middleware(['auth','admin']);

Route::get('show_event/{id}', [AdminController::class, 'show_event'])-> middleware(['auth','admin']);

Route::get('view_ticket', [AdminController::class, 'view_ticket'])-> middleware(['auth','admin']);

Route::post('add_ticket', [AdminController::class, 'add_ticket'])-> middleware(['auth','admin']);

Route::post('edit_ticket/{id}', [AdminController::class, 'edit_ticket'])->middleware(['auth', 'admin']);

Route::get('delete_ticket/{id}', [AdminController::class, 'delete_ticket'])-> middleware(['auth','admin']);

Route::get('view_order', [AdminController::class, 'view_order'])-> middleware(['auth','admin']);

Route::post('add_order', [AdminController::class, 'store_order'])-> middleware(['auth','admin']);


//Home
