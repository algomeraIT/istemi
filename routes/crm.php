<?php

use App\Http\Controllers\LeadController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ReferentController;
use App\Http\Controllers\SalesController;

Route::post('/referents/store', [ReferentController::class, 'store'])->name('referents.store');
Route::put('/referents/update/{id}', [ReferentController::class, 'update'])->name('referents.update');
Route::post('/sales/store', [SalesController::class, 'store'])->name('sales.store');
Route::put('/sales/update/{id}', [SalesController::class, 'update'])->name('sales.update');
Route::get('/leads', [LeadController::class, 'index'])->name('crm.leads');
Route::get('/contacts', [ContactController::class, 'index'])->name('crm.contacts');
Route::get('/clients', [ClientsController::class, 'index'])->name('crm.clients');
Route::get('/clients/{id}', [ClientsController::class, 'show'])->name('crm.client-detail');
Route::get('/contacts/{id}', [ContactController::class, 'goToDetail'])->name('crm.contact-detail');
