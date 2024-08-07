<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\PersonaController;

Route::middleware('guest')->group(function () {
    //Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    //Route::post('register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::group(['prefix'=>'dashboard'],function(){
        Route::resources([
            'persona'=> PersonaController::class,
        ]);
    });
    //Route::resource('persona', PersonaController::class);
});
