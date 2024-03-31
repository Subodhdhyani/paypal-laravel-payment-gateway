<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\displaycontroller;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('paypal', [PaypalController::class, 'paypal'])->name('paypal');
Route::get('success', [PaypalController::class, 'success'])->name('success');
Route::get('cancel', [PaypalController::class, 'cancel'])->name('cancel');
//Refund
Route::get('refund/{id?}', [PaypalController::class, 'refund'])->name('refund');
//Display Data 
Route::get('/display',[displaycontroller::class,'display'])->name('display');