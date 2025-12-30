<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\ExpenseManager;
use App\Livewire\IncomeManager;
use App\Livewire\GoalManager;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;

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
    return redirect()->route('login');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    // Password reset routes would go here
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/expenses', ExpenseManager::class)->name('expenses');
    Route::get('/incomes', IncomeManager::class)->name('incomes');
    Route::get('/goals', GoalManager::class)->name('goals');

    Route::post('/logout', function () {
        app(\App\Services\AuthService::class)->logoutUser();
        return redirect()->route('login');
    })->name('logout');
});
