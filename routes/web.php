<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TractorController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WorkerController;
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

Route::get('/dashboard', function () {
    return view('admin.master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/download/workers/',[\App\Http\Controllers\DownloadController::class, 'workers'])->name('download.workers');
    Route::get('/download/farmers/',[\App\Http\Controllers\DownloadController::class, 'farmers'])->name('download.farmers');
    Route::get('/report/workers/', [ReportController::class, 'worker'])->name('reports.workers');
    Route::resource('reports', ReportController::class);
    Route::resource('office', OfficeController::class);
    Route::resource('farmers', FarmerController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('tractors', TractorController::class);
    Route::resource('types', TypeController::class);
    Route::resource('workers', WorkerController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
