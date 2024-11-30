<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController; //Auth para manejar la autentificación

Route::get('/', function () {
    return "Hello World";
});

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
