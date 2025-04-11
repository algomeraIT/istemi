<?php
use App\Http\Controllers\ProjectController;

Route::get('/project', [ProjectController::class, 'index'])->name('projects.project');
