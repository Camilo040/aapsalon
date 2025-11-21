<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ChartController;

Route::middleware('auth')->get('/dashboard/charts', [ChartController::class, 'index'])
    ->name('dashboard.charts');

Route::middleware('auth')->get('/dashboard/charts', [ChartController::class, 'index'])->name('dashboard.charts');

Route::middleware('auth')->group(function () {

    // Usuarios
    Route::get('export/usuarios/excel', [ExportController::class, 'exportUsuariosExcel'])->name('export.usuarios.excel');
    Route::get('export/usuarios/csv', [ExportController::class, 'exportUsuariosCSV'])->name('export.usuarios.csv');

    // Servicios
    Route::get('export/servicios/excel', [ExportController::class, 'exportServiciosExcel'])->name('export.servicios.excel');
    Route::get('export/servicios/csv', [ExportController::class, 'exportServiciosCSV'])->name('export.servicios.csv');

    // Citas
    Route::get('export/citas/excel', [ExportController::class, 'exportCitasExcel'])->name('export.citas.excel');
    Route::get('export/citas/csv', [ExportController::class, 'exportCitasCSV'])->name('export.citas.csv');

});

Route::middleware('auth')->group(function () {

    // Página principal de reportes
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    // ============================
    // REPORTES DE USUARIOS
    // ============================
    Route::get('reports/usuarios-pdf', [ReportController::class, 'usuariosPDF'])
        ->name('reports.usuarios.pdf');

    Route::get('reports/usuarios-preview', [ReportController::class, 'usuariosPreview'])
        ->name('reports.usuarios.preview');


    // ============================
    // REPORTES DE SERVICIOS
    // ============================
    Route::get('reports/servicios-pdf', [ReportController::class, 'serviciosPDF'])
        ->name('reports.servicios.pdf');

    Route::get('reports/servicios-preview', [ReportController::class, 'serviciosPreview'])
        ->name('reports.servicios.preview');


    // ============================
    // REPORTES DE CITAS
    // ============================
    Route::get('reports/citas-pdf', [ReportController::class, 'citasPDF'])
        ->name('reports.citas.pdf');

    Route::get('reports/citas-preview', [ReportController::class, 'citasPreview'])
        ->name('reports.citas.preview');
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::resource('usuario', UsuarioController::class);
Route::resource('servicios', ServicioController::class);
Route::resource('citas', CitaController::class);


require __DIR__.'/auth.php';
