<?php

use App\Http\Controllers\InformationRequestController;
use App\Http\Controllers\ObjectionRequestController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('information-requests.create');
});

Route::prefix('information-requests')->name('information-requests.')->group(function () {
    Route::get('/create', [InformationRequestController::class, 'create'])->name('create');
    Route::post('/', [InformationRequestController::class, 'store'])->name('store');
    Route::get('/{informationRequest}', [InformationRequestController::class, 'show'])->name('show');
    Route::get('/{informationRequest}/print', [InformationRequestController::class, 'printProof'])->name('print_proof');

    Route::prefix('objection')->name('objection.')->group(function () {
        Route::post('/', [ObjectionRequestController::class, 'store'])->name('store');
        Route::get('/{objectionRequest}', [ObjectionRequestController::class, 'show'])->name('show');
        Route::get('/{objectionRequest}/print', [ObjectionRequestController::class, 'printProof'])->name('print_proof');
    });
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

        Route::prefix('requests')->name('requests.')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'indexRequests'])->name('index');
            Route::get('/{informationRequest}', [AdminDashboardController::class, 'showRequest'])->name('show');
            Route::put('/{informationRequest}/status', [AdminDashboardController::class, 'updateStatus'])->name('update_status');
            Route::delete('/{informationRequest}', [AdminDashboardController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('objections')->name('objections.')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'indexObjections'])->name('index');
            Route::get('/{objectionRequest}', [AdminDashboardController::class, 'showObjection'])->name('show');
            Route::put('/{objectionRequest}/status', [AdminDashboardController::class, 'updateObjectionStatus'])->name('update_status');
            Route::delete('/{objectionRequest}', [AdminDashboardController::class, 'destroyObjection'])->name('destroy');
        });
    });
});
