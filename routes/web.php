<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\{
  UserProfile,
  EnableTwoFactorAuthentication,
  DisableTwoFactorAuthentication,
  GenerateNewRecoveryCodes,
  DeleteAccount
};

Route::middleware('auth')->group(function () {
  Route::view('home', 'home');
  Route::middleware('verified')->prefix('user')->group(function () {
    Route::get('profile', UserProfile::class)->name('profile.show');
    Route::middleware('ajax')->group(function () {
      Route::put('deleteaccount', DeleteAccount::class)->name('profile.deleteAccount');
      Route::middleware('password.confirm')->group(function () {
        Route::put('enabletwofactors', EnableTwoFactorAuthentication::class)->name('profile.enabletwofactors');
        Route::put('disabletwofactors', DisableTwoFactorAuthentication::class)->name('profile.disabletwofactors');
        Route::put('generatenewrecoverycodes', GenerateNewRecoveryCodes::class)->name('profile.generateNewRecoveryCodes');      
      });
    });
  });
});

