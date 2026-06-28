<?php

use App\Http\Controllers\AdminAduanController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataLaporanController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    return match(auth()->user()->role) {
        'admin' => redirect()->route('dashboard'),
        'masyarakat' => redirect()->route('home'),
        'manager' => redirect()->route('manager'),
        default => abort(403),
    };
});

//auth route
Route::get('/login', function () {
    return view('auth/login');
})->name('login');
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');
Route::get('/register', function () {
    return view('auth/register');
})->name('register');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware(['auth', 'role:masyarakat'])->group(function () {

    Route::post('/feedback/{aduan}',[FeedbackController::class, 'store'])
        ->name('feedback.store');

    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');

    Route::get('/riwayat', [AduanController::class, 'riwayat'])
        ->name('riwayat');

    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/aduan-ku/{id}', [AduanController::class, 'show'])
    ->name('aduan_ku');

    Route::get('/buat-aduan', [AduanController::class, 'create'])
        ->name('aduan.create');
    Route::post('/buat-aduan', [AduanController::class, 'store'])
        ->name('aduan.store');
    Route::get('/aduan/{id}/edit', [AduanController::class, 'edit'])
    ->name('aduan.edit');
    Route::put('/aduan/{id}', [AduanController::class, 'update'])
    ->name('aduan.update');
    Route::delete('/aduan/{id}', [AduanController::class, 'destroy'])
    ->name('aduan.destroy');

});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/data_aduan', [AdminAduanController::class, 'index'])->name('data_aduan');

    Route::get('/dashboard/masyarakat',
        [MasyarakatController::class, 'index']
    )->name('masyarakat');

    Route::get('/dashboard/data_laporan', [DataLaporanController::class, 'index'])
        ->name('data_laporan');
    Route::get('/dashboard/data_laporan/buat_laporan', [LaporanController::class, 'index'])
        ->name('laporan');
    Route::post('/laporan/generate',
        [LaporanController::class, 'generate']
    )->name('laporan.generate');

    Route::get(
    '/dashboard/aduan/{aduan}',[AdminAduanController::class, 'show'])
        ->name('aduan');
    Route::patch('/dashboard/aduan/{aduan}/status', [AdminAduanController::class,'updateStatus'])
        ->name('aduan.status');
    Route::delete('/dashboard/aduan/{aduan}', [AdminAduanController::class, 'destroy'])
        ->name('admin.aduan.destroy'); 

});

Route::middleware(['auth', 'role:manager'])->group(function () {
    Route::get(
        '/manager',
        [ManagerController::class, 'dashboard']
    )->name('manager');
});



