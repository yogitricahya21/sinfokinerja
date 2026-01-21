<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SatkerController;
use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Admin\SubSatkerController;
use App\Http\Controllers\Personel\ProfileController;

Route::get('/', function () {
    if (Auth::check()) {
        $role = Auth::user()->role;

        // Logika pengalihan berdasarkan role di database
        return match ($role) {
            'admin'    => redirect()->route('admin.dashboard'),
            'kadis'    => redirect()->route('kadis.dashboard'),
            'personel' => redirect()->route('personel.dashboard'),
            default    => redirect()->route('login'),
        };
    }

    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('personel.profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/get-subsatker/{satker_id}', function ($satker_id) {
        $subsatker = \App\Models\SubSatker::where('satker_id', $satker_id)->get();
        return response()->json($subsatker);
    })->name('admin.get-subsatker');
    Route::get('/admin/settings/privacy', [AccountSettingsController::class, 'index'])->name('admin.settings.privacy');
    Route::put('/admin/settings/privacy/update', [AccountSettingsController::class, 'update'])->name('admin.settings.privacy.update');
});

// Group untuk Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/satker', [SatkerController::class, 'index'])->name('admin.satker.index');
    Route::post('/satker', [SatkerController::class, 'store'])->name('admin.satker.store');
    Route::put('/satker/{id}', [SatkerController::class, 'update'])->name('admin.satker.update');
    Route::delete('/satker/{id}', [SatkerController::class, 'destroy'])->name('admin.satker.destroy');
    Route::resource('subsatker', SubSatkerController::class)->names('admin.subsatker');
    Route::resource('subsatker', SubSatkerController::class)->names('admin.subsatker');
    Route::put('/admin/subsatker/{id}', [SubSatkerController::class, 'update'])->name('admin.subsatker.update');
    Route::resource('users', UserController::class)->names('admin.users');
    Route::get('/users/export-pdf/{id}', [UserController::class, 'exportPdf'])->name('admin.users.pdf');
});

// Group untuk Kadis
Route::middleware(['auth', 'role:kadis'])->prefix('kadis')->group(function () {
    Route::get('/dashboard', function () {
        return view('kadis.dashboard');
    })->name('kadis.dashboard');
});

// Group untuk Personel
Route::middleware(['auth', 'role:personel'])->prefix('personel')->group(function () {
    Route::get('/dashboard', function () {
        return view('personel.dashboard');
    })->name('personel.dashboard');
});

require __DIR__ . '/auth.php';
