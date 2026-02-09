<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

Route::controller(FormController::class)->group(function () {
    // Halaman utama langsung membuka list data (index)
    Route::get('/', 'index')->name('form.index'); 
    
    // Route lainnya
    Route::get('/input', 'create')->name('form.create');
    Route::post('/store', 'store')->name('form.store');
    Route::get('/edit/{id}', 'edit')->name('form.edit');
    Route::put('/update/{id}', 'update')->name('form.update');
    Route::delete('/destroy/{id}', 'destroy')->name('form.destroy');
    Route::get('/export-pdf', 'exportPdf')->name('form.export-pdf');
});