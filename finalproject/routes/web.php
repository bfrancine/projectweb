<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SpecieController;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

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

Route::get('species', [SpecieController::class, 'index']);
Route::get('species/{id}', [SpecieController::class, 'show']);

Route::get('trees', [TreeController::class, 'index']);
Route::get('trees/{id}', [TreeController::class, 'show']);
Route::get('trees/available', [TreeController::class, 'availableTrees']);

Route::get('friends', [FriendController::class, 'index']);
Route::get('friends/{id}', [FriendController::class, 'show']);

Route::post('purchase', [PurchaseController::class, 'purchaseTree']);

Route::middleware('auth')->group(function () {
    Route::get('/list-trees/{friend_id}', [FriendController::class, 'listTrees'])->name('friend.listTrees');
});

Route::middleware(['auth'])->group(function () {
    // Rutas del administrador
    Route::get('/admin/species', [AdminController::class, 'showSpecies'])->name('admin.species');
    Route::get('/admin/friends', [AdminController::class, 'showFriends'])->name('admin.friends');
    Route::get('/admin/trees', [AdminController::class, 'showTrees'])->name('admin.trees');
});

Route::resource('species', SpecieController::class);
// Ruta para mostrar el formulario de creación
Route::get('/species/create', [SpecieController::class, 'create'])->name('species.create');

// Ruta para almacenar la nueva especie
Route::post('/species', [SpecieController::class, 'store'])->name('species.store');
Route::get('/species', [SpecieController::class, 'index'])->name('species.index');  // Mostrar todas las especies
Route::get('/species/create', [SpecieController::class, 'create'])->name('species.create');  // Formulario para crear
Route::post('/species', [SpecieController::class, 'store'])->name('species.store');  // Almacenar nueva especie
Route::get('/species/{id}', [SpecieController::class, 'show'])->name('species.show');  // Ver detalles de una especie
Route::get('/species/{id}/edit', [SpecieController::class, 'edit'])->name('species.edit');  // Formulario para editar
Route::put('/species/{id}', [SpecieController::class, 'update'])->name('species.update');  // Actualizar especie
Route::delete('/species/{id}', [SpecieController::class, 'destroy'])->name('species.destroy');  // Eliminar especie

// Rutas protegidas
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/species', [AdminController::class, 'species'])->name('admin.species');
    Route::get('/admin/friends', [AdminController::class, 'friends'])->name('admin.friends');
});

Route::middleware(['auth', 'role:friend'])->group(function () {
    Route::get('/friend', [FriendController::class, 'index'])->name('friend.dashboard');
    Route::get('/friend/trees', [FriendController::class, 'trees'])->name('friend.trees');
});

// Ruta para mostrar el formulario de registro
Route::get('/register/friend', [FriendController::class, 'showRegisterForm'])->name('friend.register.form');

// Ruta para manejar el registro
Route::post('/register/friend', [FriendController::class, 'register'])->name('friend.register');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/friend/dashboard/{friend_id}', [FriendController::class, 'dashboard'])->name('friend.dashboard');

// Protege la ruta de administrador
Route::middleware('auth:admin')->get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Protege la ruta de amigo
Route::middleware('auth:friend')->get('/friend/dashboard/{friend_id}', [FriendController::class, 'dashboard'])->name('friend.dashboard');
