<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', [TransactionController::class,'index']); 

Route::resource('transactions', TransactionController::class)->except(['show']);

Route::get('transactions/report', [TransactionController::class,'report'])->name('transactions.report');
