<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;



Route::group(['middleware' => ['auth','verified']], function() {    
    Route::controller(DocumentController::class)->group(function () {
        Route::get('/document-tracking', 'index')->name('doctrack.index');
        Route::post('/doctrack', [DocumentController::class, 'store'])->name('doctrack.store');

        
    });     
});

Route::get('/documents/{id}/edit', 'App\Http\Controllers\DocumentController@edit')->name('doctrack.edit');
Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('doctrack.destroy');
Route::put('/documents/{id}', 'App\Http\Controllers\DocumentController@update')->name('documents.update');




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
