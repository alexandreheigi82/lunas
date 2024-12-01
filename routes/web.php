<?php
//require _DIR_.'/test.php';

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// Rota de depuração
Route::get('/debug', function () {
    return 'Rota de depuração funcionando';
});

// Rota pública
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);


// Rotas de autenticação
Route::post('password/update', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Middleware para verificar autenticação
Route::middleware(['auth'])->group(function () {
    // Rotas do Dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // Rotas de Usuários
    Route::put('/users/{user}/reactivate', [UserController::class, 'reactivate'])->name('users.reactivate');

    Route::get('/users/inactive', [UserController::class, 'inactive'])->name('users.inactive');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Rotas de Pacotes de Turismo
    Route::get('/packages/inactive', [PackageController::class, 'inactive'])->name('packages.inactive');
    Route::put('/packages/{package}', [PackageController::class, 'update'])->name('packages.update');
    Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
    Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
    Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');
    Route::get('/packages/{package}/edit', [PackageController::class, 'edit'])->name('packages.edit');
    Route::delete('/packages/{package}', [PackageController::class, 'destroy'])->name('packages.destroy');

    //Route::get('/packages/inactive', [PackageController::class, 'inactive'])->name('packages.inactive');
    //Route::get('/packages/inactive', function () { return 'Pacotes desativados - Teste';});

    // Rotas de Clientes
    Route::get('/clients/search', [ClientController::class, 'search'])->name('clients.search');
    Route::resource('clients', ClientController::class)->middleware('auth');


    // Rotas de Vendas
    Route::resource('sales', SaleController::class)->middleware('auth');
    Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');
});
