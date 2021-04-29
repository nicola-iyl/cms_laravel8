<?php

use App\Http\Controllers\Cms\LoginController;
use App\Http\Controllers\Cms\RegisterController;
use App\Http\Controllers\Cms\DashboardController;
use App\Http\Controllers\Cms\ShopController;
use App\Http\Controllers\Cms\OrderController;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;
use Illuminate\Support\Facades\Route;



Route::get('/register',   [RegisterController::class, 'showForm'])  ->name('register');
Route::post('/register',  [RegisterController::class, 'register'])  ->name('register.exec');
Route::get('/logout',     [LoginController::class, 'logout'])       ->name('logout');

//tutte le rotte per cui non si deve essere loggati
Route::middleware(['is_cms_guest'])->group(function ()
{
    Route::get('/login',            [LoginController::class, 'showForm'])       ->name('login');
    Route::post('/exec_login',      [LoginController::class, 'login'])          ->name('login.exec');
    Route::get('/forgot_password',  [LoginController::class, 'forgot_password'])->name('password.request');
    Route::post('/email_password',  [LoginController::class, 'email_password']) ->name('password.email');
    Route::get('/reset_pwd/{token}',[LoginController::class, 'reset_password']) ->name('password.reset');
    Route::post('/update_pwd',      [LoginController::class, 'update_password'])->name('password.update');

});

//tutte le rotte che richiedono il login altrimenti vengono rimandati alla paggina login
Route::middleware(['is_cms_auth'])->group(function ()
{
    //rotte dedicate all'utente ADMIN
    Route::middleware(['is_admin'])->group(function()
    {
        Route::get('/logs',        [LogViewerController::class,'index'])          ->name('admin.log');
        Route::get('/admin',       [DashboardController::class,'admin_dashboard'])->name('admin.dashboard');

        Route::get('/order_admin', [OrderController::class,'order_admin'])        ->name('admin.order');

    });

});
