<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Crm\Clients as ClientIndex;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ReferentController;
use App\Http\Controllers\SalesController;

Route::middleware(['auth'])->group(function () {
    Route::post('/referents/store', [ReferentController::class, 'store'])->name('referents.store');
    Route::put('/referents/update/{id}', [ReferentController::class, 'update'])->name('referents.update');
    Route::post('/sales/store', [SalesController::class, 'store'])->name('sales.store');
    Route::put('/sales/update/{id}', [SalesController::class, 'update'])->name('sales.update');
    Route::prefix('crm')->name('crm.')->group(function () {
        Route::get('/{status}', ClientIndex::class)->name('client.index');
        Route::get('/{client}/{id}', [ContactController::class, 'goToDetail'])->name('contact-detail');
    });
    Route::get('/clients/{id}', [ClientsController::class, 'show'])->name('crm.client-detail');
});
