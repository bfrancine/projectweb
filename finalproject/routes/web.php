<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\SpeciesController;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\TreeHistoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [DashboardController::class, 'index'])->name('home');

// Routes for guests only
Route::middleware('guest')->group(function () {
    // Login Routes
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    // Registration Routes (only for friends)
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

// Logout Route (requires authentication)
Route::post('logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])
        ->name('admin.dashboard');

    // Species management
    Route::resource('species', SpeciesController::class)
        ->except(['show']);

    // Tree management
    Route::get('/trees', [TreeController::class, 'index'])
        ->name('trees.index');
    Route::post('/trees', [TreeController::class, 'store'])
        ->name('trees.store');
    Route::put('/trees/{tree}', [TreeController::class, 'update'])
        ->name('trees.update');
    Route::delete('/trees/{tree}', [TreeController::class, 'destroy'])->name('trees.destroy');

    // User management
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Friends Management
    Route::get('/admin/friends', [FriendController::class, 'index'])->name('friends.index');
    Route::get('/admin/friends/{friend}', [FriendController::class, 'show'])->name('friends.show');
    Route::get('/admin/friends/{friend}/trees', [TreeController::class, 'listFriendTrees'])
        ->name('admin.friend.trees');
    Route::put('/admin/friends/{friend}/trees/{tree}', [TreeController::class, 'updateFriendTree'])
        ->name('admin.friend.trees.update');

    Route::post('/admin/tree-updates/{tree}', [TreeHistoryController::class, 'store'])
        ->name('admin.tree-updates.store');
});

// Error routes
Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
})->name('unauthorized');