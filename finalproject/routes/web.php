<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\PurchaseController;
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

Route::middleware(['auth'])->group(function () {
    // Logout Route (requires authentication)
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    // Available Trees (requires authentication)
    Route::get('/tree-history/history/{tree}', [TreeHistoryController::class, 'history'])
        ->name('tree-history.index');
});

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

    Route::post('/admin/tree-history/{tree}', [TreeHistoryController::class, 'store'])
        ->name('admin.tree-history.store');
});

// Operator routes
Route::middleware(['auth', 'role:operator'])->group(function () {
    Route::get('/operator/dashboard', [DashboardController::class, 'operatorDashboard'])
        ->name('operator.dashboard');

    Route::get('/operator/trees', [TreeController::class, 'listPurchasedTrees'])
        ->name('operator.trees.list');

    Route::post('/tree-history/{tree}', [TreeHistoryController::class, 'store'])
        ->name('tree-history.store');
});

// Friend routes
Route::middleware(['auth', 'role:friend'])->group(function () {
    // Dashboard
    Route::get('/friend/dashboard', [DashboardController::class, 'friendDashboard'])
        ->name('friend.dashboard');

    // Trees
    Route::get('/friend/my-trees', [FriendController::class, 'myTrees'])
        ->name('friend.my-trees');

    Route::get('/friend/available-trees', [FriendController::class, 'availableTrees'])
        ->name('friend.available-trees');

    Route::get('/friend/trees/{tree}', [TreeController::class, 'show'])
        ->name('friend.trees.show');

    // Purchases
    Route::post('/friend/trees/{tree}/purchase', [PurchaseController::class, 'store'])
        ->name('friend.purchases.store');
});

// Error routes
Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
})->name('unauthorized');
