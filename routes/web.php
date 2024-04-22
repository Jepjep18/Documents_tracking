<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/document-tracking', [DocumentController::class, 'index'])->name('doctrack.index');
    Route::post('/doctrack', [DocumentController::class, 'store'])->name('doctrack.store');
    Route::get('/documents/{id}/edit', [DocumentController::class, 'edit'])->name('doctrack.edit');
    Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('doctrack.destroy');
    Route::put('/documents/{id}', [DocumentController::class, 'update'])->name('doctrack.update');
    Route::get('/get-personnel/{department}', [DocumentController::class, 'getPersonnel'])->name('get.personnel');

});




Route::resource('departments', DepartmentController::class);


Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::resource('/permissions', PermissionController::class);
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke');
     // Update the route for creating a user
     Route::get('/create', [UserController::class, 'create'])->name('create');
     Route::post('/users', [UserController::class, 'store'])->name('users.store');
     Route::post('/{user}/assign-department', [UserController::class, 'assignDepartment'])->name('users.departments');
    Route::delete('/{user}/remove-department', [UserController::class, 'removeDepartment'])->name('users.remove.department');


});

Route::get('/personnel', function () {
    return view('personnel.index');
})->middleware(['auth', 'role:personnel'])->name('personnel.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');


require __DIR__.'/auth.php';

