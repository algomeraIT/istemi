<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Crm\Client\Index as ClientIndex;
use App\Livewire\Crm\Client\Show as ClientShow;
use App\Http\Controllers\SalesController;

use App\Livewire\Crm\Products\Index as ProductsIndex;

use App\Livewire\Crm\Quotes\Index as QuotesIndex;
use App\Livewire\Crm\Quotes\Show as QuotesShow;
use App\Livewire\Crm\Quotes\Create as QuotesCreate;
use App\Livewire\Crm\Quotes\Edit as QuotesEdit;


Route::middleware(['auth'])->group(function () {
    Route::post('/sales/store', [SalesController::class, 'store'])->name('sales.store');
    Route::put('/sales/update/{id}', [SalesController::class, 'update'])->name('sales.update');

    // CRM
    Route::prefix('crm')->name('crm.')->group(function () {
        // Products
        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', ProductsIndex::class)->name('index');
        });

        // Client
        Route::prefix('client')->name('client.')->group(function () {
            Route::get('/{status}', ClientIndex::class)->name('index');
            Route::get('/{status}/{id}', ClientShow::class)->name('show');
        });

        // Quotes
        Route::prefix('quotes')->name('quotes.')->group(function () {
            Route::get('/', QuotesIndex::class)->name('index');
            Route::get('/create', QuotesCreate::class)->name('create');
            Route::get('/edit/{quote}', QuotesEdit::class)->name('edit');
            Route::get('/{quote}', QuotesShow::class)->name('show');
        });

    });
});
