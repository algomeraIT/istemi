<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Crm\Client\Index as ClientIndex;
use App\Livewire\Crm\Client\Show as ClientShow;
use App\Http\Controllers\SalesController;
use App\Livewire\Crm\Products\Index as ProductsIndex;


Route::middleware(['auth'])->group(function () {
    Route::post('/sales/store', [SalesController::class, 'store'])->name('sales.store');
    Route::put('/sales/update/{id}', [SalesController::class, 'update'])->name('sales.update');

    // CRM
    Route::prefix('crm')->name('crm.')->group(function () {
        Route::name('client.')->group(function () {
            Route::get('/{status}', ClientIndex::class)->name('index');
            Route::get('/{status}/{id}', ClientShow::class)->name('show');
        });

        Route::name('products.')->group(function () {
            Route::get('/', ProductsIndex::class)->name('index');
        });
    });
});
