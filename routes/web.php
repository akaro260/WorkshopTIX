<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Peserta\DashboardController as PesertaDashboardController;
use App\Http\Controllers\Admin\WorkshopController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Controllers\Peserta\WorkshopController as PesertaWorkshopController;
use App\Http\Controllers\Peserta\RegistrationController as PesertaRegistrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // Dashboard berdasarkan role
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('peserta.dashboard');
    })->name('dashboard');

    // Halaman khusus admin
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin')
        ->group(function () {

            Route::get('/dashboard', [AdminDashboardController::class, 'index'])
                ->name('dashboard');
            Route::resource('workshops', WorkshopController::class);
            Route::get('/registrations', [RegistrationController::class, 'index'])
                ->name('registrations.index');

            Route::get('/registrations/{registration}', [RegistrationController::class, 'show'])
                ->name('registrations.show');

        });

    // Halaman khusus peserta
    Route::prefix('peserta')
        ->name('peserta.')
        ->middleware('role:peserta')
        ->group(function () {

            Route::get('/dashboard', [PesertaDashboardController::class, 'index'])
                ->name('dashboard');
            Route::post(
                '/workshops/{workshop}/register',
                [PesertaRegistrationController::class, 'store']
            )->name('registrations.store');

            Route::get('/workshops', [PesertaWorkshopController::class, 'index'])
                ->name('workshops.index');

            Route::get(
                '/registrations/{registration}/checkout',
                [PaymentController::class, 'checkout']
            )->name('payments.checkout');

            Route::get(
                '/registrations/{registration}/check',
                [PaymentController::class, 'checkStatus']
            )->name('payments.check');
        });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/payment', [PaymentController::class, 'index'])->name('demo-payment.index');
Route::post('/payment/pay', [PaymentController::class, 'pay'])->name('demo-payment.pay');
Route::post('/payment/check', [PaymentController::class, 'check'])->name('demo-payment.check');


require __DIR__ . '/auth.php';
