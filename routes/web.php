<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('login', function () {
            return view('admin.login');
        })->name('admin.login');
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::get('/', function () {
            return view('admin.home');
        })->name('admin.home');

        Route::prefix('setting')->group(function () {
            Route::get('user', function () {
                // return 'Setting User';
                return view('admin.setting.user');
            })->name('setting.user');

            Route::get('permission', function () {
                return 'Setting Permission';
            })->name('setting.permission');

            Route::get('role', function () {
                return 'Setting Role';
            })->name('setting.role');
        });
    });
});
