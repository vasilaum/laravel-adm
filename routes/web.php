<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\SystemModuleController;
use App\Http\Controllers\SystemPermissionController;
use App\Http\Controllers\ContentCategoryController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContentImageController;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

Route::get('login',     [LoginController::class, 'index'])->name('login');
Route::get('logout',    [LoginController::class, 'logout'])->name('logout');
Route::post('auth',     [LoginController::class, 'auth'])->name('auth');

Route::middleware(['auth', 'system.module.permission'])->group(function () {
    ## USERS ##
    Route::get('users',             [UserController::class, 'index'])->name('users.index');
    Route::get('users/form/{id?}',  [UserController::class, 'form'])->name('users.form');
    Route::post('users',            [UserController::class, 'store'])->name('users.store');
    Route::put('users',             [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}',     [UserController::class, 'destroy'])->name('users.destroy');

    ## USERS PERMISSIONS ##
    Route::get('user/{userId}/permissions',      [UserPermissionController::class, 'index'])->name('users.permissions.index');
    Route::post('user/{userId}/permissions',     [UserPermissionController::class, 'store'])->name('users.permissions.store');

    ## SYSTEM MODULES ##
    Route::get('system-modules',                [SystemModuleController::class, 'index'])->name('system.modules.index');
    Route::get('system-modules/form/{id?}',     [SystemModuleController::class, 'form'])->name('system.modules.form');
    Route::post('system-modules',               [SystemModuleController::class, 'store'])->name('system.modules.store');
    Route::put('system-modules',                [SystemModuleController::class, 'update'])->name('system.modules.update');
    Route::delete('system-modules/{id}',        [SystemModuleController::class, 'destroy'])->name('system.modules.destroy');

    ## SYSTEM PERMISSIONS ##
    Route::get('system-modules/{moduleId}/permissions',                 [SystemPermissionController::class, 'index'])->name('system.permissions.index')->whereNumber('moduleId');
    Route::get('system-modules/{moduleId}/permissions/form/{id?}',      [SystemPermissionController::class, 'form'])->name('system.permissions.form')->whereNumber('moduleId');
    Route::post('system-permissions',                                   [SystemPermissionController::class, 'store'])->name('system.permissions.store');
    Route::put('system-permissions',                                    [SystemPermissionController::class, 'update'])->name('system.permissions.update');
    Route::delete('system-permissions/{id}',                            [SystemPermissionController::class, 'destroy'])->name('system.permissions.destroy');

    ## CONTENT CATEGORIES ##
    Route::get('content-categories',                [ContentCategoryController::class, 'index'])->name('content.categories.index');
    Route::get('content-categories/form/{id?}',     [ContentCategoryController::class, 'form'])->name('content.categories.form');
    Route::post('content-categories',               [ContentCategoryController::class, 'store'])->name('content.categories.store');
    Route::put('content-categories',                [ContentCategoryController::class, 'update'])->name('content.categories.update');
    Route::delete('content-categories/{id}',        [ContentCategoryController::class, 'destroy'])->name('content.categories.destroy');

    ## CONTENTS ##
    Route::get('contents',              [ContentController::class, 'index'])->name('contents.index');
    Route::get('contents/form/{id?}',   [ContentController::class, 'form'])->name('contents.form');
    Route::post('contents',             [ContentController::class, 'store'])->name('contents.store');
    Route::put('contents',              [ContentController::class, 'update'])->name('contents.update');
    Route::delete('contents/{id}',      [ContentController::class, 'destroy'])->name('contents.destroy');

    ## CONTENTS IMAGES ##
    Route::get('content-images',            [ContentImageController::class, 'index'])->name('content.images.index');
    Route::post('content-images',           [ContentImageController::class, 'store'])->name('content.images.store');
    Route::delete('content-images/{id}',    [ContentImageController::class, 'destroy'])->name('content.images.destroy');
    Route::put('content-images',            [ContentImageController::class, 'update'])->name('content.images.update');
});

## DASHBOARD ##
Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

## GET IMAGES FROM STORAGE ##
Route::get('storage/{filename}', function ($filename) {
    $path = storage_path('app\public\\' . str_replace('--', '\\', $filename));

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->name('get.storage.images');
