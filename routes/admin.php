<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\isAdmin;
            //\App\Http\Middleware\isEmployee::class,
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth',isAdmin::class]

],function (){

   //list admin routes


    Route::resource('employees', UsersController::class);

});
