<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ejecutar storage link
Route::get('storage-link', function () {
    if (file_exists(public_path('storage'))) {
        return ('El directorio "public/storage" ya existe.');
    }

    app('files')->link(
        storage_path('app/public'),
        public_path('storage')
    );

    return 'El directorio [public/storage] ha sido vinculado.';
});

Route::get('/cache', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('config:cache');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('administracion', AdminController::class);
    Route::resource('roles', RoleController::class);
    Route::get('users/subir', [UserController::class, 'subir'])->name('users.subir');
    Route::post('/import', [UserController::class, 'import'])->name('import');
    Route::resource('users', UserController::class);
});