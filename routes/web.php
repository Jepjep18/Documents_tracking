<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;


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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function(){
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
});

Route::get('/personnel', function () {
    return view('personnel.index');
})->middleware(['auth', 'role:personnel'])->name('personnel.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');


require __DIR__.'/auth.php';

