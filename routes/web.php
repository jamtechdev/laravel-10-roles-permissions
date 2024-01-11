<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    Route::group(['middleware' => ['guest']], function() {
        
        Route::get('/register',[RegisterController::class,'show'])->name('register.show');
        Route::post('/register',[RegisterController::class,'register'])->name('register.perform');

        Route::get('/',[LoginController::class,'show'])->name('login.show');
        Route::post('/login',[LoginController::class,'login'])->name('login.perform');

    });

   

    Route::group(['middleware' => ['auth', 'permission']], function()
    {
        Route::group(['prefix' => 'permissions'], function() {

            Route::get('index',[PermissionController::class,'index'])->name('permissions.index');
            Route::get('create',[PermissionController::class,'create'])->name('permissions.create');
            Route::post('store',[PermissionController::class,'store'])->name('permissions.store');
            Route::get('show',[PermissionController::class,'show'])->name('permissions.show');
            Route::get('edit/{id}',[PermissionController::class,'edit'])->name('permissions.edit');
            Route::post('update',[PermissionController::class,'update'])->name('permissions.update');
            Route::get('destroy/{id}',[PermissionController::class,'destroy'])->name('permissions.destroy');
        });

        Route::group(['prefix' => 'roles'], function() {

            Route::get('index',[RoleController::class,'index'])->name('roles.index');
            Route::get('create',[RoleController::class,'create'])->name('roles.create');
            Route::post('store',[RoleController::class,'store'])->name('roles.store');
            Route::get('show/{id}',[RoleController::class,'show'])->name('roles.show');
            Route::get('edit/{id}',[RoleController::class,'edit'])->name('roles.edit');
            Route::post('update',[RoleController::class,'update'])->name('roles.update');
            Route::get('destroy/{id}',[RoleController::class,'destroy'])->name('roles.destroy');
        });
    
        Route::group(['prefix' => 'users'], function() {
            
            Route::get('dashboard',[UserController::class,'dashboard'])->name('users.dashboard');

            Route::get('index',[UserController::class,'index'])->name('users.index');
            Route::get('create',[UserController::class,'create'])->name('users.create');
            Route::post('store',[UserController::class,'store'])->name('users.store');
            Route::get('show',[UserController::class,'show'])->name('users.show');
            Route::get('edit/{id}',[UserController::class,'edit'])->name('users.edit');
            Route::post('update',[UserController::class,'update'])->name('users.update');
            Route::get('destroy/{id}',[UserController::class,'destroy'])->name('users.destroy');

            Route::get('logout',[UserController::class,'perform'])->name('users.perform');
        });
    });
});
