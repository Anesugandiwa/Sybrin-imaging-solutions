<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Middleware\isEmployee;


Route::group([
    'prefix' => 'employee-portal',
    'middleware' => ['auth',isEmployee::class]
],function (){

    //list employees routes

    Route::get('home', function (){
        return 'I am home';
    });
});
