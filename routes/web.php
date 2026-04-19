<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\CategoryController;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
    Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::patch('admin/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
});

require __DIR__.'/settings.php';
