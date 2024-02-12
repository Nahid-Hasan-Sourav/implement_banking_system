<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Deposit\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\Withdraw\WithdrawController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');;

Route::middleware('auth')->group(function () {
    Route::get('/transaction', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/deposit', [DepositController::class, 'index'])->name('deposit.index');
    Route::post('/deposit/store', [DepositController::class, 'store'])->name('deposit.store');
    Route::get('/all-deposit', [DepositController::class, 'view'])->name('deposit.view');
    Route::get('/withdraw', [WithdrawController::class, 'index'])->name('withdraw.index');
    Route::post('/withdraw/store', [WithdrawController::class, 'store'])->name('withdraw.store');
    Route::get('/all-withdraw', [WithdrawController::class, 'view'])->name('withdraw.view');
    



    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
