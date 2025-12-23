<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CatalogDetailController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog/{slug}', [CatalogDetailController::class, 'show'])->name('catalog.detail');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin Routes (Protected by Auth)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Catalog Management
    Route::resource('catalogs', CatalogController::class);

    // Contact Messages
    Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{message}/toggle-read', [ContactMessageController::class, 'toggleRead'])->name('messages.toggle-read');
    Route::delete('/messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
