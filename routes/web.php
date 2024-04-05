<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartmentController;


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/document-tracking', [DocumentController::class, 'index'])->name('doctrack.index');
    Route::post('/doctrack', [DocumentController::class, 'store'])->name('doctrack.store');
    Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('doctrack.edit');
    Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('doctrack.destroy');
    Route::put('/documents/{id}', [DocumentController::class, 'update'])->name('doctrack.update');
});

Route::get('/user-management', [UserController::class, 'index'])->name('user.management');

Route::resource('departments', DepartmentController::class);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

require __DIR__.'/adminauth.php';
