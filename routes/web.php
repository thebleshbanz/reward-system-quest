<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/subscriptions', [SubscriptionController::class, 'index'] )->middleware(['auth'])->name('subscriptions');

Route::post('/user_subscription', [SubscriptionController::class, 'userSubscription'] )->middleware(['auth'])->name('user_subscription');

Route::get('user/referrals', [UserController::class, 'referrals'])->middleware(['auth'])->name('user_referrals');

require __DIR__.'/auth.php';

