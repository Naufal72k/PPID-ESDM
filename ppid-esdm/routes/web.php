<?php

use App\Http\Controllers\InformationRequestController;
use App\Http\Controllers\ObjectionRequestController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\UserStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('information-requests.create');
});

Route::prefix('information-requests')->name('information-requests.')->group(function () {
    Route::get('/create', [InformationRequestController::class, 'create'])->name('create');
    Route::post('/', [InformationRequestController::class, 'store'])->name('store');

    // Route baru tanpa parameter untuk menampilkan detail permohonan dari sesi
    Route::get('/show', [InformationRequestController::class, 'showFromSession'])->name('show');

    // Route baru tanpa parameter untuk cetak bukti permohonan dari sesi
    Route::get('/print-proof', [InformationRequestController::class, 'printProofFromSession'])->name('print_proof');

    Route::prefix('objection')->name('objection.')->group(function () {
        Route::post('/', [ObjectionRequestController::class, 'store'])->name('store');

        // Route baru tanpa parameter untuk menampilkan detail keberatan dari sesi
        Route::get('/show', [ObjectionRequestController::class, 'showFromSession'])->name('show');

        // Route baru tanpa parameter untuk cetak bukti keberatan dari sesi
        Route::get('/print-proof', [ObjectionRequestController::class, 'printProofFromSession'])->name('print_proof');
    });
});




// Rute baru untuk status user (ini akan menjadi halaman pencarian utama)
Route::prefix('status')->name('user.status.')->group(function () {
    Route::get('/', [UserStatusController::class, 'index'])->name('index');
    Route::post('/search', [UserStatusController::class, 'search'])->name('search');
    Route::get('/show-request', [UserStatusController::class, 'showRequest'])->name('show-request');
    Route::get('/show-objection', [UserStatusController::class, 'showObjection'])->name('show-objection'); // Perbaikan: Pastikan ini memanggil showObjection

    // Tambahkan route untuk cetak bukti permohonan dan keberatan tanpa parameter
    Route::get('/print-request-proof', [UserStatusController::class, 'printRequestProof'])->name('print-request-proof');
    Route::get('/print-objection-proof', [UserStatusController::class, 'printObjectionProof'])->name('print-objection-proof');
});



Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

        Route::prefix('requests')->name('requests.')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'indexRequests'])->name('index');
            Route::get('/{informationRequest}', [AdminDashboardController::class, 'showRequest'])->name('show'); // Admin tetap bisa melihat detail dengan ID
            Route::put('/{informationRequest}/status', [AdminDashboardController::class, 'updateStatus'])->name('update_status');
            Route::delete('/{informationRequest}', [AdminDashboardController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('objections')->name('objections.')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'indexObjections'])->name('index');
            Route::get('/{objectionRequest}', [AdminDashboardController::class, 'showObjection'])->name('show'); // Admin tetap bisa melihat detail dengan ID
            Route::put('/{objectionRequest}/status', [AdminDashboardController::class, 'updateObjectionStatus'])->name('update_status');
            Route::delete('/{objectionRequest}', [AdminDashboardController::class, 'destroyObjection'])->name('destroy');
        });
    });
});
