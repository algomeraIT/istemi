<?php
use App\Http\Controllers\ProjectController;

Route::middleware(['auth'])->group(function () {
Route::get('/project', [ProjectController::class, 'index'])->name('projects.project');
});