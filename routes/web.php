<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\GrupController;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| Dashboard (FIX — hanya 1 route, kirim total kontak & grup)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    $totalKontak = \App\Models\Kontak::where('user_id', auth()->id())->count();
    $totalGrup = \App\Models\Grup::where('user_id', auth()->id())->count();

    return view('dashboard', compact('totalKontak', 'totalGrup'));
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile User
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| CRUD Kontak
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    Route::resource('kontak', KontakController::class);
});

/*
|--------------------------------------------------------------------------
| CRUD Grup
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // semua route CRUD grup
    Route::resource('grup', GrupController::class);

    // ✅ Tambahan route export CSV untuk grup
    Route::get('/grup/{id}/export-csv', [GrupController::class, 'exportCsv'])
        ->name('grup.export.csv');
});

/*
|--------------------------------------------------------------------------
| Dashboard Kontak (Statistik)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/kontak/dashboard', function () {
    $total = \App\Models\Kontak::where('user_id', auth()->id())->count();
    $newToday = \App\Models\Kontak::where('user_id', auth()->id())
                ->whereDate('created_at', today())
                ->count();

    return view('contacts.dashboard', compact('total', 'newToday'));
})->name('kontak.dashboard');

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
