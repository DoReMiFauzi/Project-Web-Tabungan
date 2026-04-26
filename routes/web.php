<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\ExportController;

Route::get('/',[TabunganController::class,'index'])->name('Tabungan.index');
Route::get('/Tabung-Uang',[TabunganController::class,'create'])->name('Tabungan.create');
Route::post('/store',[TabunganController::class,'store'])->name('Tabungan.store');
Route::get('/Tarik-Uang',[TabunganController::class,'viewTarik'])->name('Tabungan.viewTarik');
Route::post('/tarik',[TabunganController::class,'tarik'])->name('Tabungan.tarik');
Route::get('/Data-Riwayat',[TabunganController::class,'viewRiwayat'])->name('Tabungan.viewRiwayat');
Route::delete('/destroy/{id}',[TabunganController::class,'destroy'])->name('Tabungan.destroy');


Route::get('/export',[ExportController::class,'export'])->name('Export.export');


